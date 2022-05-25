<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\daycare;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'name'              => 'required|string|max:255',
            'npsn'              => 'required|string|max:255',
            'educational_stage' => 'required|string|max:255',
            'status'            => ['required','string', Rule::in(['negeri', 'swasta'])],
            'address'           => 'required|string|max:1000',
            'rt'                => 'nullable|integer',
            'rw'                => 'nullable|integer',
            'postcode'          => 'required|string|max:255',
            'district'          => 'required|string|max:255',
            'subdistrict'       => 'required|string|max:255',
            'province'          => 'required|string|max:255',
            'city'              => 'required|string|max:255',
            'country'           => 'required|string|max:255',
            'latitude'          => 'required|string|max:255',
            'longitude'         => 'required|string|max:255',
            'establishment_number'          => 'required|string|max:255',
            'establishment_date'            => 'required|date',
            'ownership_status'              => 'required|string|max:255',
            'operational_permission_number' => 'required|string|max:255',
            'operational_permission_date'   => 'required|date',
            'is_accept_handicap'            => 'required|boolean',
            'bank_number'                   => 'nullable|string|max:255',
            'bank_name'                     => 'nullable|string|max:255',
            'bank_branch'                   => 'nullable|string|max:255',
            'bank_owner_name'               => 'nullable|string|max:255',
            'is_mbs'                        => 'required|boolean',
            'land_ownership_area'           => 'required|numeric',
            'land_not_ownership_area'       => 'required|numeric',
            'npwp'                          => 'required|string|max:255',
            'npwp_owner_name'               => 'required|string|max:255',
            'phone_number'                  => 'required|string|max:255',
            'fax_number'                    => 'nullable|string|max:255',
            'email'                         => 'nullable|string|max:255',
            'website'                       => 'nullable|string|max:255',
            'active_hour'                   => 'required|numeric',
            'is_accept_bos'                 => 'required|boolean',
            'is_iso_certification'          => 'nullable|string|max:255',
            'power_resource'                => 'required|string|max:255',
            'watt'                          => 'required|string|max:255',
            'internet_provider'             => 'nullable|string|max:255',
            'alt_internet_provider'         => 'nullable|string|max:255',
            'headmaster'                    => 'required|string|max:255',
            'administrator'                 => 'required|string|max:255',
            'acreditation'                  => 'nullable|string|max:255',
            'curriculum'                    => 'required|string|max:255',
        ]);
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
