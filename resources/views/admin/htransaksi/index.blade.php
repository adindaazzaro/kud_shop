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
                  <a href="#" class="btn btn-info"><i class="fas fa-plus-square"></i> Print</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="data" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                            <th></th>
                            <th class="text-center">
                                #
                            </th>
                            <th>Kode Transaksi</th>
                            <th>Nama Pelanggan</th>
                            <th>Jumlah Obat</th>
                            <th>Total</th>
                            <th>Action</th>
                            <th></th>
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

@endsection
@push('js')

<script>
var _URL_DATATABLE = '{{ url("datatable/htransaksi") }}';
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
                orderable: false,
                searchable: false,
                width: '4%',
                responsive: false,
                data:null,
                className: 'dt-control',
                defaultContent: ''

            },{
                "data": 'DT_RowIndex',
                orderable: false,
                searchable: false,
                width: '4%',
                className: 'text-center'
            },{
                data: 'kode_transaksi',
                name: 'kode_transaksi',
            },{
                data: 'nama_pelanggan',
                name: 'nama_pelanggan',
            },{
                data: 'jumlah_barang',
                name: 'jumlah_barang',
            },{
                data: 'total_harga',
                name: 'total_harga',
            },{
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },{
                data: 'detail',
                name: 'detail',
                orderable: false,
                searchable: false,
                visible : false

            }]
        });
    
    
    }
    function format(value) {
    // console.log();
        return value.detail;
    };
    $('table tbody').on('click', 'td.dt-control', function () {
        var tr = $(this).closest('tr');
        var row = _TABLE.row(tr);
        console.log(row);
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('dt-hasChild shown');
        } else {
            // Open this row
            // console.log(row.data()[4]);
            row.child(format(row.data())).show();
            tr.addClass('dt-hasChild shown');
        }
    });
</script>


@endpush

