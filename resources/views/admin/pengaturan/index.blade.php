@extends('app')

@section('content')
<form action="{{url('admin/pengaturan-update')}}" method="POST" enctype="multipart/form-data">
@csrf
<div class="row">
    <div class="col col-md-6">
        <div class="card card-outline card-info">
            <div class="card-header">
                Informasi
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label for="">Logo App</label>
                        <div class="image-live" data-target="logo" data-ext="png,jpg,jpeg">
                            <input type="file" class="d-none file-live" name="logo">
                            <input type="file" class="d-none" value="{{$data->logo}}" name="logo-old">
                            @if($data->logo != null)
                            <img id="logo" src="{{asset('image/setting/'.$data->logo)}}"  style="width: 100px; height:100px" class="shadow mb-4 img-fluid" alt="" srcset="">
                            @else
                            <img id="logo" src="{{asset('assets/dist/img/default-150x150.png')}}"  style="width: 100px; height:100px" class="shadow mb-4 img-fluid" alt="" srcset="">
                            @endif
                        </div>
                        <div class="text-danger mb-4"><small><i>File Tidak Boleh Lebih besar dari 1Mb</i></small></div>
                    </div>
                    <div class="col">
                        <label for="">Favicon</label>
                        <div class="image-live" data-target="favicon" data-ext="ico,png">
                            <input type="file" class="d-none file-live" name="favicon">
                            <input type="file" class="d-none" value="{{$data->favicon}}" name="favicon-old">
                            @if($data->favicon != null)
                            <img id="favicon" src="{{asset('image/setting/'.$data->favicon)}}" style="width: 100px; height:100px" class="shadow mb-4 img-fluid" alt="" srcset="">
                            @else
                            <img id="favicon" src="{{asset('assets/dist/img/default-150x150.png')}}"  style="width: 100px; height:100px" class="shadow mb-4 img-fluid" alt="" srcset="">
                            @endif
                        </div>
                        <div class="text-danger mb-4"><small><i>File Tidak Boleh Lebih besar dari 1Mb</i></small></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="">Nama App</label>
                    <input type="text" name="nama" class="form-control" id="" value="{{$data->nama}}" placeholder="Enter Name App">
                </div>
                <div class="form-group">
                    <label for="">No Telepon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+62</span>
                        </div>
                        <input type="text" name="no_telp" class="form-control" value="{{$data->no_telp}}" data-inputmask='"mask": "999-9999-9999"' placeholder="___-____-____" data-mask required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="{{$data->email}}" id="" placeholder="Enter email">
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-6">
        <div class="card card-outline card-danger">
            <div class="card-header">
                Media Sosial
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Link Akun Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{$data->facebook}}" id="" placeholder="Enter Link Facebook">
                </div>
                <div class="form-group">
                    <label for="">Link Akun Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="{{$data->twitter}}" id="" placeholder="Enter Akun Twitter">
                </div>
                <div class="form-group">
                    <label for="">Link Akun Instagram</label>
                    <input type="text" name="instagram" class="form-control" {{$data->instagram}} id="" placeholder="Enter Akun Instagram">
                </div>
                <div class="form-group">
                    <label for="">Link Akun Tiktok</label>
                    <input type="text" name="tiktok" class="form-control" {{$data->tiktok}} id="" placeholder="Enter Akun Tiktok">
                </div>
                <div class="form-group">
                    <label for="">Link Akun Youtube</label>
                    <input type="text" name="youtube" class="form-control" {{$data->youtube}} id="" placeholder="Enter Akun Youtube">
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-success" type="submit" ><i class="fas fa-save"></i> Simpan</button>
</form>
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