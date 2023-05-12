@extends('app')

@section('content')
<div class="row">
    <div class="col">
        <h3>{{$subTitle}}</h3>
    </div>
    <div class="col text-right">
        <a href="{{route('admin.alamat.pelanggan.create',$id_kustomer)}}" class="btn btn-primary"><i class="fas fa-plus-square"></i> Tambah Alamat</a>
    </div>
</div>
<hr>
<div class="row">
    @foreach ($alamat as $al)
    <div class="col-md-3">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title font-weight-bold text-capitalize">{{$al->nama}}</h3>
                <div class="card-tools">
                    <a class="btn btn-tool text-info" href="{{route('admin.alamat.pelanggan.edit',['id_alamat'=>encrypt($al->id),'id_kustomer'=>$id_kustomer])}}">
                        <i class="fa-solid fa-pencil"></i> Edit
                    </a>
                    <a class="btn btn-tool  text-danger" href="{{route('admin.alamat.pelanggan.delete',['id_alamat'=>encrypt($al->id),'id_kustomer'=>$id_kustomer])}}">
                        <i class="fa-regular fa-trash-can"></i> Hapus
                    </a>
                </div>

            </div>

            <div class="card-body">
                {{$al->alamat}}
            </div>

        </div>

    </div>
    @endforeach
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
@endpush

