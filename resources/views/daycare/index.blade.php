@extends("daycare.template")

@section('content')
 
    <div class="text-right">
        <a href="{{url('daycares/create')}}" class="btn btn-md btn-success">Create Data</a>
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
        <div class="spinner-border" role="status">
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

        function renderData(data){
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
            $(".body-table").append(html);
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
            $(".spinner-border").css("visibility", "hidden");
            showBtnLoadMore();
        }

        function showLoading(){
            $(".spinner-border").css("visibility", "visible");
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

