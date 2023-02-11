@extends('app')
@section('content')

<?php 
use App\Traits\Helper;
?>
<div class="row m-2">
    <div class="col">
        
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">{{$subTitle}}</h3>
                <div class="card-tools">
                  <a id="btn-add-data" href="#" data-toggle="modal" data-target="#modal-form" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                            <th class="text-center">
                                #
                            </th>
                            <th>Nama</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- build modal --}}
<div id="target-modal"></div>
@endsection
@push('js')
<script type="text/javascript" src="{{asset('assets/dist/js/modal.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/dist/js/save.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/dist/js/delete.js')}}"></script>
<script>
// BUILD MODAL
makeModalForm('<?= Helper::includeAsJsString("admin.kategori-obat.form") ?>','modal-form');
// CUKUP UBAH VARIABLE BERIKUT
var _STATUS_SUBMIT = 0;
var _TITLE_MODAL_ADD = "Tambah Kategori Obat";
var _TITLE_MODAL_UPDATE = "Ubah Kategori Obat";
var _ID_UPDATE = "";
var _URL_INSERT = '{{route("admin.kategori-obat.store")}}';
var _URL_UPDATE = '{{url("admin/kategori-obat")}}/';
var _URL_DATATABLE = '{{ url("datatable/kategori-obat") }}';
var _TABLE = null;
// SESUAIKAN COLUMN DATATABLE
// SESUAIKAN FIELD EDIT MODAL
setDataTable();
function setDataTable() {
    _TABLE = $('#data').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: _URL_DATATABLE,
        },
        rowReorder: {
            selector: 'td:nth-child(1)'
        },
        responsive: true,
        columns: [{
                "data": 'DT_RowIndex',
                orderable: false,
                searchable: false,
                width: '4%',
                className: 'text-center'
            },{
                data: 'nama',
                name: 'nama',
            },{
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }],
            "initComplete": function(settings, json) {
                $(document).on("keyup","input[name=nama]",function(e){
                    if(checkKategori(json.data,$(this))){
                        $(this).addClass("is-invalid");
                        $(this).siblings(".invalid").remove();
                        $("#btn-submit").addClass("disabled");
                        $(this).after("<div class='text-danger invalid'>Nama Kategori sudah tersedia</div>");
                    }else{
                        $("#btn-submit").removeClass("disabled");
                        $(this).siblings(".invalid").remove();
                        $(this).removeClass("is-invalid");
                    }
                    if($(this).val() == ""){
                        $("#btn-submit").addClass("disabled");
                    }
                });
                
            }
        });
    
    
    }
$(document).on('click','#btn-add-data',function(e){
    _STATUS_SUBMIT = 1;
    clearInput("#form-data");
    resetModal();
    $("#modal-form").find(".modal-title").text(_TITLE_MODAL_ADD);
});
$(document).on('click','.edit',function(e){
    var modal = $("#modal-form");
    clearInput("#form-data");
    e.preventDefault();
    $.ajax({
        type: "get",
        url: $(this).attr("href"),
        dataType: "JSON",
        success: function (response) {
        if(response.status){
                _STATUS_SUBMIT = 2;
                modal.find(".modal-title").text(_TITLE_MODAL_UPDATE);
                _ID_UPDATE = response.data.key;
                modal.find("input[name=nama]").val(response.data.nama);
                modal.modal("show");
            }
        }
    });
});
$(document).on('click','#btn-submit', function () {
    var current_modal = $(this).closest('.modal');
    if(_STATUS_SUBMIT == 1){ // new
        saveForm(
            $('#form-data'),
            _URL_INSERT,
            current_modal,
            1
            );
    }else if(_STATUS_SUBMIT == 2){ // update
        var afterSave = saveForm(
            $('#form-data'),
            _URL_UPDATE+_ID_UPDATE,
            current_modal,
            2,
            'PUT'
            );
        if(afterSave){
            _ID_UPDATE = 0;
        }
    }
});
function checkKategori(data,el){
    var result = false;
    data.forEach(element => {
        // console.log(element.nama.toLowerCase());
        if(el.val().toLowerCase() === element.nama.toLowerCase()){
            console.log(element.nama)
            result = true;
        }
    });
    return result;
}
function resetModal(){
    $("#modal-form").find("input").val("");
    $("#btn-submit").addClass("disabled");
    $(".invalid").remove();
}
// submit data

</script>


@endpush

