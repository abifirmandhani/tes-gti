@extends("daycare.template")

@section('content')

    <div class="row mb-2">
        <h3 class="col-10">{{$type}} Data</h3>
        <div class=" col-2">
            <a href="{{url('daycares')}}" class="btn btn-md btn-success col-12">List Sekolah</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    School Identity
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Sekolah</label>
                        <input type="text" name="name" class="form-inputan form-control">
                        <p class="error-text" id="error-name"></p>
                    </div>
                    <div class="form-group">
                        <label for="">NPSN</label>
                        <input type="text" name="npsn" class="form-inputan form-control">
                        <p class="error-text" id="error-npsn"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Jenjang Pendidikan</label>
                        <input type="text" name="educational_stage" class="form-inputan form-control">
                        <p class="error-text" id="error-educational_stage"></p>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Status Sekolah</label>
                        <input type="text" name="status" class="form-inputan form-control">
                        <p class="error-text" id="error-status"></p>
                    </div>

                    <label for="">Alamat</label>
                    <textarea class="form-inputan form-control" name="address" cols="30" rows="5"></textarea>
                        <p class="error-text" id="error-address"></p>
                    <div class="form-group">
                        <label for="">RT</label>
                        <input type="text" name="rt" class="form-inputan form-control">
                        <p class="error-text" id="error-rt"></p>
                    </div>
                    <div class="form-group">
                        <label for="">RW</label>
                        <input type="text" name="rw" class="form-inputan form-control">
                        <p class="error-text" id="error-rw"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Pos</label>
                        <input type="text" name="postcode" class="form-inputan form-control">
                        <p class="error-text" id="error-postcode"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Kecamatan</label>
                        <input type="text" name="district" class="form-inputan form-control">
                        <p class="error-text" id="error-district"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Kelurahan</label>
                        <input type="text" name="subdistrict" class="form-inputan form-control">
                        <p class="error-text" id="error-subdistrict"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Kabupaten/Kota</label>
                        <input type="text" name="city" class="form-inputan form-control">
                        <p class="error-text" id="error-city"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Provinsi</label>
                        <input type="text" name="province" class="form-inputan form-control">
                        <p class="error-text" id="error-province"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Negara</label>
                        <input type="text" name="country" class="form-inputan form-control">
                        <p class="error-text" id="error-country"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Lintang Geografis</label>
                        <input type="text" name="latitude" class="form-inputan form-control">
                        <p class="error-text" id="error-latitude"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Bujur Geografis</label>
                        <input type="text" name="longitude" class="form-inputan form-control">
                        <p class="error-text" id="error-longitude"></p>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    Additional Data
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">SK Pendirian Sekolah</label>
                        <input type="text" name="establishment_number" class="form-inputan form-control">
                        <p class="error-text" id="error-establishment_number"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal SK Pendirian</label>
                        <input type="text" name="establishment_date" class="form-inputan form-control">
                        <p class="error-text" id="error-establishment_date"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Status Kepemilikan</label>
                        <input type="text" name="ownership_status" class="form-inputan form-control">
                        <p class="error-text" id="error-ownership_status"></p>
                    </div>
                    <div class="form-group">
                        <label for="">SK Izin Operasional</label>
                        <input type="text" name="operational_permission_number" class="form-inputan form-control">
                        <p class="error-text" id="error-operational_permission_number"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal SK Izin Operasional</label>
                        <input type="text" name="operational_permission_date" class="form-inputan form-control">
                        <p class="error-text" id="error-operational_permission_date"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Kebutuhan Khusus dilayani</label>
                        <input type="text" name="is_accept_handicap" class="form-inputan form-control">
                        <p class="error-text" id="error-is_accept_handicap"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Rekening</label>
                        <input type="text" name="bank_number" class="form-inputan form-control">
                        <p class="error-text" id="error-bank_number"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Bank</label>
                        <input type="text" name="bank_name" class="form-inputan form-control">
                        <p class="error-text" id="error-bank_name"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Cabang KCP/Unit</label>
                        <input type="text" name="bank_branch" class="form-inputan form-control">
                        <p class="error-text" id="error-bank_branch"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Rekening Atas Nama</label>
                        <input type="text" name="bank_owner_name" class="form-inputan form-control">
                        <p class="error-text" id="error-bank_owner_name"></p>
                    </div>
                    
                    <div class="form-group">
                        <label for="">MBS</label>
                        <input type="text" name="is_mbs" class="form-inputan form-control">
                        <p class="error-text" id="error-is_mbs"></p>
                    </div>

                    <div class="form-group">
                        <label for="">Luas Tanah Milik (m2)</label>
                        <input type="text" name="land_ownership_area" class="form-inputan form-control">
                        <p class="error-text" id="error-land_ownership_area"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Luas Tanah Bukan Milik (m2)</label>
                        <input type="text" name="land_not_ownership_area" class="form-inputan form-control">
                        <p class="error-text" id="error-land_not_ownership_area"></p>
                    </div>
                    <div class="form-group">
                        <label for="">NPWP</label>
                        <input type="text" name="npwp" class="form-inputan form-control">
                        <p class="error-text" id="error-npwp"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Wajib Pajak</label>
                        <input type="text" name="npwp_owner_name" class="form-inputan form-control">
                        <p class="error-text" id="error-npwp_owner_name"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    Contact
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="text" name="phone_number" class="form-inputan form-control">
                        <p class="error-text" id="error-phone_number"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Fax</label>
                        <input type="text" name="fax_number" class="form-inputan form-control">
                        <p class="error-text" id="error-fax_number"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-inputan form-control">
                        <p class="error-text" id="error-email"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Website</label>
                        <input type="text" name="website" class="form-inputan form-control">
                        <p class="error-text" id="error-website"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Waktu Pelayanan</label>
                        <input type="text" name="active_hour" class="form-inputan form-control">
                        <p class="error-text" id="error-active_hour"></p>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Bersedia Menerima Bos?</label>
                        <input type="text" name="is_accept_bos" class="form-inputan form-control">
                        <p class="error-text" id="error-is_accept_bos"></p>
                    </div>

                    <div class="form-group">
                        <label for="">Sertifikasi ISO</label>
                        <input type="text" name="is_iso_certification" class="form-inputan form-control">
                        <p class="error-text" id="error-is_iso_certification"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Sumber Listrik</label>
                        <input type="text" name="power_resource" class="form-inputan form-control">
                        <p class="error-text" id="error-power_resource"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Daya Listrik (Watt)</label>
                        <input type="text" name="watt" class="form-inputan form-control">
                        <p class="error-text" id="error-watt"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Akses Internet</label>
                        <input type="text" name="internet_provider" class="form-inputan form-control">
                        <p class="error-text" id="error-internet_provider"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Akses Internet Alternatif</label>
                        <input type="text" name="alt_internet_provider" class="form-inputan form-control">
                        <p class="error-text" id="error-alt_internet_provider"></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    Contact
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Kepala Sekolah</label>
                        <input type="text" name="headmaster" class="form-inputan form-control">
                        <p class="error-text" id="error-headmaster"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Operator Pendataan</label>
                        <input type="text" name="administrator" class="form-inputan form-control">
                        <p class="error-text" id="error-administrator"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Akreditasi</label>
                        <input type="text" name="acreditation" class="form-inputan form-control">
                        <p class="error-text" id="error-acreditation"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Kurikulum</label>
                        <input type="text" name="curriculum" class="form-inputan form-control">
                        <p class="error-text" id="error-curriculum"></p>
                    </div>
                </div>
            </div>

            <br>
            <div style="visibility:hidden" class="loading text-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
            <button id="btnSubmit" class="col-12 btn btn-mn btn-success">Simpan Data</button>
        </div>
    </div>

    

@endsection
@section('script')
    <script>
        type = '';
        $("document").ready(function(){
            type = "{{$type}}"
            id = "{{$id}}"
            
            if(type == "Edit"){
                getData(id)
            }
        })

        $("#btnSubmit").on("click", function(){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    submitData();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                }
            })
        })

        function submitData(){
            showLoading();
            hideValidationError()
            let url = "{{url('/api/v1/daycares')}}";
            let method = "POST";
            if(type == "Edit"){
                method = "PUT"
                id = "{{$id}}"
                url = "{{url('/api/v1/daycares')}}"+"/"+id;
            }
  
            var object = {}; 
            let listFormInput = $(".form-inputan");
            let listRadio = $(".form-check-input");
            
            for (let index = 0; index < listFormInput.length; index++) {
                object[$(listFormInput[index]).attr('name')] = $(listFormInput[index]).val();
            }
            for (let index = 0; index < listRadio.length; index++) {
                object[$(listRadio[index]).attr('name')] = $('input[name="'+$(listRadio[index]).attr('name')+'"]:checked').val();
            }
            
            var data = JSON.stringify(object);

            $.ajax({
            url: url,
            data: data,
            processData: false,
            contentType: "application/json",
            type: method,
            success: function(data){
                hideLoading();
                hideValidationError()
                showMessage(true, "success");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                hideLoading();
                statusCode = jqXHR.status;
                if(statusCode == 400){
                    showValidationError()
                    showMessage(false, "Bad Request");
                    data = jqXHR.responseJSON.data;
                    for (var key in data) {
                        if (!data.hasOwnProperty(key)) continue;

                        // your code
                        $("#error-"+key).text(data[key])
                    }
                }else{
                    showMessage(false, "Internal Server Error");
                }
            }
            });
        }

        function getData(id){
            let url = "{{url('/api/v1/daycares')}}"+"/"+id;

            showLoading();
            $.ajax({
                url: url,
                statusCode: {
                    500: function(xhr) {
                        hideLoading();
                        showMessage(false, "Internal Server Error");
                    },
                },
                success: function(result){
                    hideLoading();
                    if(!result.status){
                        showMessage(false, result.message);
                    }else{
                        data = result.data;
                        for (var key in data) {
                            if (!data.hasOwnProperty(key)) continue;

                            var el = $("[name='"+ key +"']").not('.form-check-input').val(data[key]);

                            var radios = $('input:radio[name='+key+']');
                            if(radios.length > 0){
                                for (let j = 0; j < radios.length; j++) {
                                    radios.filter('[value="'+data[key]+'"]').prop('checked', false);
                                    if($(radios[j]).is(':checked') === false) {
                                        radios.filter('[value="'+data[key]+'"]').prop('checked', true);
                                    }
                                }
                            }
                        }
                    }
                },
                
            });
        }

        function hideSubmitBtn(){
            $("#btnSubmit").css("visibility", "hidden");
        }

        function showSubmitBtn(){
            $("#btnSubmit").css("visibility", "visible");
        }

        function showLoading(){
            $(".loading").css("visibility", "visible");
            hideSubmitBtn();
        }

        function hideLoading(){
            $(".loading").css("visibility", "hidden");
            showSubmitBtn();
        }
    </script>
@endsection