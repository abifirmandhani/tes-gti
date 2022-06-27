<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\daycare;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use ZipArchive;
use Illuminate\Support\Facades\Bus;
use App\Jobs\ImportProcess;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DaycareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $limit = 10;
            $page = $request->get("page") ?? 0;
            $offset = $page * $limit;

            $fullUrl = $request->fullUrlWithQuery([
                'page' => $page + 1
            ]);

            $data = daycare::skip($offset)->take($limit)->orderBy("id", "desc")->get();
            // $data = daycare::get();

            return $this->ResponsePaginateJson(
                true,
                CONFIG("statusmessage.SUCCESS"),
                $limit,
                $fullUrl,
                $data
            );
        } catch (\Exception $e) {
            Log::error($e);
            return $this->ResponseJsonError();
        }
    }

    public function validator($request){
        return $validator = Validator::make($request, [
            'name'              => 'nullable|string|max:255',
            'npsn'              => 'nullable|string|max:255',
            'educational_stage' => 'nullable|string|max:255',
            'status'            => 'nullable|string|max:255',
            'address'           => 'nullable|string|max:1000',
            'rt'                => 'nullable|string|max:255',
            'rw'                => 'nullable|string|max:255',
            'postcode'          => 'nullable|string|max:255',
            'district'          => 'nullable|string|max:255',
            'subdistrict'       => 'nullable|string|max:255',
            'province'          => 'nullable|string|max:255',
            'city'              => 'nullable|string|max:255',
            'country'           => 'nullable|string|max:255',
            'latitude'          => 'nullable|string|max:255',
            'longitude'         => 'nullable|string|max:255',
            'establishment_number'          => 'nullable|string|max:255',
            'establishment_date'            => 'nullable|string|max:255',
            'ownership_status'              => 'nullable|string|max:255',
            'operational_permission_number' => 'nullable|string|max:255',
            'operational_permission_date'   => 'nullable|string|max:255',
            'is_accept_handicap'            => 'nullable|string|max:255',
            'bank_number'                   => 'nullable|string|max:255',
            'bank_name'                     => 'nullable|string|max:255',
            'bank_branch'                   => 'nullable|string|max:255',
            'bank_owner_name'               => 'nullable|string|max:255',
            'is_mbs'                        => 'nullable|string|max:255',
            'land_ownership_area'           => 'nullable|string|max:255',
            'land_not_ownership_area'       => 'nullable|string|max:255',
            'npwp'                          => 'nullable|string|max:255',
            'npwp_owner_name'               => 'nullable|string|max:255',
            'phone_number'                  => 'nullable|string|max:255',
            'fax_number'                    => 'nullable|string|max:255',
            'email'                         => 'nullable|string|max:255',
            'website'                       => 'nullable|string|max:255',
            'active_hour'                   => 'nullable|string|max:255',
            'is_accept_bos'                 => 'nullable|string|max:255',
            'is_iso_certification'          => 'nullable|string|max:255',
            'power_resource'                => 'nullable|string|max:255',
            'watt'                          => 'nullable|string|max:255',
            'internet_provider'             => 'nullable|string|max:255',
            'alt_internet_provider'         => 'nullable|string|max:255',
            'headmaster'                    => 'nullable|string|max:255',
            'administrator'                 => 'nullable|string|max:255',
            'acreditation'                  => 'nullable|string|max:255',
            'curriculum'                    => 'nullable|string|max:255',
        ]);
    }

    public function import(Request $request){
        try {   
            $validator = Validator::make($request->all(), [
                'file'   => 'required|file|mimes:zip|max:5120',
            ]); 
            if ($validator->fails()) {
                $data = $validator->errors();
                return $this->ResponseJson(
                    false, 
                    CONFIG("statusmessage.BAD_REQUEST"),
                    $data,
                    400
                );
            }
            $batch  = Bus::batch([])->dispatch();
            $zip = new ZipArchive;
            if ($zip->open($request->file('file')->getPathName(), ZipArchive::RDONLY) === TRUE) {
                $zip->extractTo(public_path().'/import');
                for ($i=0; $i < $zip->count(); $i++) { 
                    $path = public_path().'/import/'.$zip->getNameIndex($i);
                    $batch->add(new ImportProcess($path));
                }

                $zip->close();
                return $this->ResponseJson(
                    true, 
                    CONFIG("statusmessage.SUCCESS"),
                    []
                );
            }else{
                Log::error("Failed open ZIP");
                return $this->ResponseJsonError();
            }
        } catch (\Exception $e) {
            Log::error($e);
            return $this->ResponseJsonError();
        }
    }

    public function uploadLargeFiles(Request $request) {
        try {
            $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
    
            if (!$receiver->isUploaded()) {
                // file not uploaded
            }
        
            $fileReceived = $receiver->receive(); // receive file
            if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
                $batch  = Bus::batch([])->dispatch();
                $zip = new ZipArchive;
                if ($zip->open($fileReceived->getPathName(), ZipArchive::RDONLY) === TRUE) {
                    $zip->extractTo(public_path().'/import');
                    
                    for ($i=0; $i < $zip->count(); $i++) { 
                        $path = public_path().'/import/'.$zip->getNameIndex($i);
                        $batch->add(new ImportProcess($path));
                    }

                    $file = $fileReceived->getFile();
                    $zip->close();
                    
                    unlink($file->getPathname());
                    return [
                        'path' => asset('storage/'),
                        'filename' =>""
                    ];
                }else{
                    Log::error("Failed open ZIP");
                    return $this->ResponseJsonError();
                }
            }
        
            // otherwise return percentage information
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone(),
                'status' => true
            ];
        } catch (\Exception $e) {
            Log::error($e);
            return $this->ResponseJsonError();
        }
    }

    function daycareGenerator() {
        foreach (daycare::cursor() as $daycare) {
            yield $daycare;
        }
    }

    public function export(Request $request){
    
        // Export consumes only a few MB, even with 10M+ rows.
        $daycare = $this->daycareGenerator();
        return (new FastExcel($daycare))->download('file.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = $this->validator($request->all());
            if ($validator->fails()) {
                $data = $validator->errors();
                return $this->ResponseJson(
                    false, 
                    CONFIG("statusmessage.BAD_REQUEST"),
                    $data,
                    400
                );
            }
            daycare::create($request->all());
            return $this->ResponseJson(
                true, 
                CONFIG("statusmessage.SUCCESS"),
            );
        } catch (\Exception $e) {
            Log::error($e);
            return $this->ResponseJsonError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = daycare::findOrFail($id);
            return $this->ResponseJson(
                true,
                CONFIG("statusmessage.SUCCESS"),
                $data
            );
        } catch (\Exception $e) {
            Log::error($e);
            return $this->ResponseJsonError();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = $this->validator($request->all());
            if ($validator->fails()) {
                $data = $validator->errors();
                return $this->ResponseJson(
                    false, 
                    CONFIG("statusmessage.BAD_REQUEST"),
                    $data,
                    400
                );
            }
            daycare::findOrFail($id)->update($request->all());
            return $this->ResponseJson(
                true, 
                CONFIG("statusmessage.SUCCESS"),
            );
        } catch (\Exception $e) {
            Log::error($e);
            return $this->ResponseJsonError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $data = daycare::findOrFail($id);
            $data->delete();
            return $this->ResponseJson(
                true, 
                CONFIG("statusmessage.SUCCESS"),
            );
        } catch (\Exception $e) {
            Log::error($e);
            return $this->ResponseJsonError();
        }
    }



}
