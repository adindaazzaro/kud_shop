@extends('app')

@section('content')
<div class="row">
    <div class="col">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">{{$subTitle}}</h3>
                <div class="card-tools">
                  <a href="{{route('admin.pelanggan.create')}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah</a>
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
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telepon</th>
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
@endsection

@push('js')
@if(session('msg'))
<script>
    iziToast.success({
        title: 'Success',
        message: "{{session('msg')}}",
        position: 'bottomCenter'
    });
</script>
@endif
<script>
    var _URL_DATATABLE = '{{ url("datatable/pelanggan") }}';
    setDataTable();
    function setDataTable() {
        $('#data').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: _URL_DATATABLE,
            },
            responsive: true,
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                    width: '4%',
                    className: 'text-center'
                },{
                    data: 'foto_conv',
                    name: 'foto',
                },{
                    data: 'nama',
                    name: 'nama',
                },{
                    data: 'email',
                    name: 'email',
                },{
                    data: 'no_hp',
                    name: 'no_hp',
                },{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
        });
    }
</script>
<script type="text/javascript" src="{{asset('/')}}assets/dist/js/delete.js"></script>

@endpush
