@extends("daycare.template")

@section('content')
 
    <div class="text-right">
        <a href="{{url('daycares/create')}}" class="btn btn-md btn-success">Create Data</a>
        <button id="btnImport" onclick="openModalFile()" class="btn btn-md btn-primary">
            <div style="display:none;" class="spinner-border spinner-border-sm spinner-import" role="status">
                <span  class="visually-hidden">Loading...</span>
            </div>
            Import Data
        </button>
        <a href="{{url('api/v1/export')}}" class="btn btn-md btn-warning">Export</a>
        
    </div>

    <!-- Modal -->
    <div class="modal fade" id="uploadFileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <input required class="form-control" type="file" id="formFile" multiple="multiple">
                <p class="error-text" id="error-file"></p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="importCsv()">Save changes</button>
        </div>
        </div>
    </div>
    </div>

    <br>
    <div style="overflow-x: auto;">
        <table class="table table-bordered table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col">Nama Daycare</th>
                    <th scope="col">NPSN</th>
                    <th scope="col">Jenjang Pendidikan</th>
                    <th scope="col">Status Sekolah</th>
                    <th scope="col">Alamat Sekolah</th>
                    <th scope="col">RT / RW</th>
                    <th scope="col">Kode Pos</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kabupaten/Kota</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Negara</th>
                    <th scope="col">Lintang Geografis</th>
                    <th scope="col">Bujur Geografis</th>
                    <th scope="col">SK Pendirian Sekolah</th>
                    <th scope="col">Tanggal SK Pendirian</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="body-table">
                
            </tbody>

        </table>
    </div>
    <div class="text-center">
        <div class="spinner-border spinner-border-load" role="status">
            <span class="sr-only"></span>
        </div>
    </div>
    <div class="text-center">
        <button style="visibility:hidden" id="btnLoadMore" data-url="" class="btn btn-md btn-primary">Load More</button>
    </div>

@endsection
@section('script')
    <script>
        $("document").ready(function(){
            let url = "{{url('/api/v1/daycares')}}";
            getData(url);
        })

        function openModalFile(){
            $("#error-file").text("")
            $("#formFile").val(null);
            $("#uploadFileModal").modal("show");
        }

        function importCsv(){  
            var formData = new FormData();
            fileCsv = $("#formFile").get(0).files[0];
            let listFile = $("#formFile").get(0).files;

            if(listFile.length < 1){
                $("#error-file").text("file wajib diisi")
                return
            }

            for (let index = 0; index < listFile.length; index++) {
                // if(listFile[index].size > 1048576  ){
                //     $("#error-file").text("Maximal ukuran file 1Mb")
                //     return
                // }
                formData.append("file", listFile[index])
            }

            showLoadingImport();
            $("#uploadFileModal").modal("hide");

            let url = "{{url('/api/v1/import')}}";

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function (result) {
                    hideLoadingImport()
                    if(!result.status){
                        showMessage(false, result.message);
                    }else{
                        result.data.forEach(element => {
                            renderData([element], true);
                        });
                        showMessage(true, "Success");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    hideLoadingImport()
                    statusCode = jqXHR.status;
                    if(statusCode == 400){
                        data = jqXHR.responseJSON.data;
                        for (var key in data) {
                            if (!data.hasOwnProperty(key)) continue;
                            showMessage(false, "Bad Request : " + data[key]);
                            return;
                        }
                    }else{
                        showMessage(false, "Internal Server Error");
                    }
                },
                contentType: false,
                processData: false
            });
        }

        function showLoadingImport(){
            $(".spinner-import").css("display", "");
            $("#btnImport").text("loading...");
            $("#btnImport").prop('disabled', true);
        }

        function hideLoadingImport(){
            $(".spinner-import").css("display", "none");
            $("#btnImport").text("Import Data");
            $("#btnImport").prop('disabled', false);
        }

        function getData(url){
            showLoading()
            $.ajax({
                url: url,
                statusCode: {
                    500: function(xhr) {
                        showMessage(false, "Internal Server Error");
                    },
                },
                success: function(result){
                    hideLoading()
                    if(!result.status){
                        showMessage(false, result.message);
                    }else{
                        renderData(result.data);
                        if(result.next_page != null){
                            $("#btnLoadMore").attr("data-url", result.next_page);
                        }else{
                            hideBtnLoadMore();
                        }
                    }
                },
                
            });
        }

        function renderData(data, isInsertLast = false){
            let html = ``;
            for (let index = 0; index < data.length; index++) {
                html += `<tr id="row-`+ data[index].id +`">
                    <td>`+ data[index].name +`</td>
                    <td>`+ data[index].npsn +`</td>
                    <td>`+ data[index].educational_stage +`</td>
                    <td>`+ data[index].status +`</td>
                    <td>`+ data[index].address +`</td>
                    <td>`+ data[index].rt +` / ` + data[index].rw + `</td>
                    <td>`+ data[index].postcode +`</td>
                    <td>`+ data[index].subdistrict +`</td>
                    <td>`+ data[index].district +`</td>
                    <td>`+ data[index].city +`</td>
                    <td>`+ data[index].province +`</td>
                    <td>`+ data[index].country +`</td>
                    <td>`+ data[index].latitude +`</td>
                    <td>`+ data[index].longitude +`</td>
                    <td>`+ data[index].establishment_number +`</td>
                    <td>`+ data[index].establishment_date +`</td>
                    <td>`+ getButtonAction(data[index].id) +`</td>

                </tr>`;
            }
            if(!isInsertLast){
                $(".body-table").append(html);
            }else{
                $(".body-table").prepend(html);
            }
        }

        function getButtonAction(id){
            return `
                <a href="{{url('daycares').'/'.'`+id+`'.'/edit'}}" class="col-12 mb-1 btn btn-sm btn-warning">edit</a>
                <button onclick="showModalDelete(`+id+`)" class="col-12 btn btn-sm btn-danger">delete</button>
            `;
        }

        $("#btnLoadMore").on("click", function(){
            getData($(this).attr("data-url"));
        })

        function showBtnLoadMore(){
            $("#btnLoadMore").css("visibility", "visible");
        }

        function hideBtnLoadMore(){
            $("#btnLoadMore").css("visibility", "hidden");
        }

        function hideLoading(){
            $(".spinner-border-load").css("visibility", "hidden");
            showBtnLoadMore();
        }

        function showLoading(){
            $(".spinner-border-load").css("visibility", "visible");
            hideBtnLoadMore();
        }

        function showModalDelete(id){
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
            confirmButtonText: 'Yes, Delete!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteData(id);
                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                }
            })
        }

        function deleteData(id){
            let url = "{{url('/api/v1/daycares')}}"+"/"+id;
            $.ajax({
                url: url,
                processData: false,
                contentType: "application/json",
                type: "DELETE",
                success: function(data){
                    $("#row-"+id).remove();
                    showMessage(true, "success");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    showMessage(false, "Internal Server Error");
                }
            });
        }
    </script>
@endsection

