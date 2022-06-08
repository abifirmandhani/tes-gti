<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\daycare;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Bus\Batchable;

class ImportProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;
    
    public $tries = 5;
    public $timeout = 600;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $path;
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($this->path);
    
                $sheet = $spreadsheet->getActiveSheet();
                
                $payload = [];
    
                $payload["name"] = $sheet->getCell('D8')->getValue();
                $payload["npsn"] = $sheet->getCell('D9')->getValue();
                $payload["educational_stage"] = $sheet->getCell('D10')->getValue();
                $payload["status"] = $sheet->getCell('D11')->getValue();
                $payload["address"] = $sheet->getCell('D12')->getValue();
                $payload["rt"] = $sheet->getCell('D13')->getValue();
                $payload["rw"] = $sheet->getCell('F13')->getValue();
                $payload["postcode"] = $sheet->getCell('D14')->getValue();
                $payload["subdistrict"] = $sheet->getCell('D15')->getValue();
                $payload["district"] = $sheet->getCell('D16')->getValue();
                $payload["city"] = $sheet->getCell('D17')->getValue();
                $payload["province"] = $sheet->getCell('D18')->getValue();
                $payload["country"] = $sheet->getCell('D19')->getValue();
                $payload["latitude"] = $sheet->getCell('D20')->getValue();
                $payload["longitude"] = $sheet->getCell('D21')->getValue();
    
                $payload["establishment_number"] = $sheet->getCell('D23')->getValue();
                $payload["establishment_date"] = $sheet->getCell('D24')->getValue();
                $payload["ownership_status"] = $sheet->getCell('D25')->getValue();
                $payload["operational_permission_number"] = $sheet->getCell('D26')->getValue();
                $payload["operational_permission_date"] = $sheet->getCell('D27')->getValue();
                $payload["is_accept_handicap"] = $sheet->getCell('D28')->getValue();
                $payload["bank_number"] = $sheet->getCell('D29')->getValue();
                $payload["bank_name"] = $sheet->getCell('D30')->getValue();
                $payload["bank_branch"] = $sheet->getCell('D31')->getValue();
                $payload["bank_owner_name"] = $sheet->getCell('D32')->getValue();
                $payload["is_mbs"] = $sheet->getCell('D33')->getValue();
                $payload["land_ownership_area"] = $sheet->getCell('D34');
                $payload["land_not_ownership_area"] = $sheet->getCell('D35')->getValue();
                $payload["npwp_owner_name"] = $sheet->getCell('D36')->getValue();
                $payload["npwp"] = $sheet->getCell('D37')->getValue();
    
                $payload["phone_number"] = $sheet->getCell('D39')->getValue();
                $payload["fax_number"] = $sheet->getCell('D40')->getValue();
                $payload["email"] = $sheet->getCell('D41')->getValue();
                $payload["website"] = $sheet->getCell('D42')->getValue();
    
                $payload["active_hour"] = $sheet->getCell('D44')->getValue();
                $payload["is_accept_bos"] = $sheet->getCell('D45')->getValue();
                $payload["is_iso_certification"] = $sheet->getCell('D46')->getValue();
                $payload["power_resource"] = $sheet->getCell('D47')->getValue();
                $payload["watt"] = $sheet->getCell('D48')->getValue();
                $payload["internet_provider"] = $sheet->getCell('D49')->getValue();
                $payload["alt_internet_provider"] = $sheet->getCell('D50')->getValue();
    
                $payload["headmaster"] = $sheet->getCell('D52')->getValue();
                $payload["administrator"] = $sheet->getCell('D53')->getValue();
                $payload["acreditation"] = $sheet->getCell('D54')->getValue();
                $payload["curriculum"] = $sheet->getCell('D55')->getValue();
    
                foreach ($payload as $key => $value) {
                    $payload[$key] = (string)$value;
                }
                
                $validator = $this->validator($payload);
                if ($validator->fails()) {
                    $data = $validator->errors();
                    return $this->ResponseJson(
                        false, 
                        CONFIG("statusmessage.BAD_REQUEST"),
                        $data,
                        400
                    );
                }
    
                $data = daycare::create($payload);
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
}
