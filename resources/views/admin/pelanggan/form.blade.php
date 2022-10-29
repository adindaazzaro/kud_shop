@extends('app')
<style>
    #gmap_canvas,.gmap_canvas,.mapouter{
        width: 100% !important;
        
    }
</style>
@section('content')
<?php 
use App\Traits\Helper;  

$name[] = 'foto';
$name[] = 'nama';
$name[] = 'email';
$name[] = 'password';
$name[] = 'no_hp';
$name[] = 'alamat';

?>

<div class="card  card-outline card-primary">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title">Isikan dengan data yang sesuai</h3>
        <div class="card-tools ml-auto">
            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i>
            </button>
        </div>
    </div>
    
    <div class="card-body">
       
        <form action="{{$url}}" method="post" enctype="multipart/form-data">
            @csrf
            {{$method != null ? $method : ''}}
            <div class="row">
                <div class="col-md-12">
                    <label for="">Foto</label>
                    <div class="image-live" data-target="{{$name[0]}}" data-ext="png,jpg,jpeg">
                        <input type="file" class="d-none file-live" name="{{$name[0]}}">
                       @if (Helper::showData($data,$name[0]) != null)
                            <input type="text" class="d-none" value="{{Helper::showData($data,$name[0])}}" name="{{$name[0]}}-old">
                            <img id="{{$name[0]}}" src="{{asset('image/pelanggan/'.$data->foto)}}"  style="width: 200px;" class="shadow rounded mb-4 img-fluid" alt="{{$data[$name[1]]}}" srcset="">
                        @else
                            <img id="{{$name[0]}}" src="{{asset('assets/dist/img/default-150x150.png')}}"  style="width: 200px;" class="shadow rounded mb-4 img-fluid" alt="" srcset="">
                        @endif
                    </div>
                    <div class="text-danger mb-4"><small><i>File Tidak Boleh Lebih besar dari 1Mb</i></small></div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Nama</label>
                    <input type="text" class="form-control @error($name[1]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[1])}}" name="{{$name[1]}}" autocomplete="off" />
                </div>
                <div class="form-group col-md-12">
                    <label for="">Email</label>
                    <input type="text" class="form-control @error($name[2]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[2])}}" name="{{$name[2]}}" autocomplete="off" />
                    @error($name[2])<small class="text-danger">{{$message}}</small>@enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="">Password</label>
                    <input type="text" class="form-control @error($name[3]) is-invalid @enderror"
                        value="" name="{{$name[3]}}" autocomplete="off" />
                    @error($name[3])<small class="text-danger">{{$message}}</small>@enderror
                    
                </div>
                <div class="form-group col-md-12">
                    <label for="">No Telepon</label>
                    <div class="input-group @error($name[4]) is-invalid @enderror">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+62</span>
                        </div>
                        <input type="text" name="{{$name[4]}}" class="form-control" value="{{Helper::showData($data,$name[4])}}" data-inputmask='"mask": "999-9999-9999"' placeholder="___-____-____" data-mask required>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Alamat</label>
                    <textarea id="{{$name[5]}}" type="text" class="form-control @error($name[5]) is-invalid @enderror" cols="5"
                        rows="6" style="height:100px" name="{{$name[5]}}"
                        autocomplete="off">{{Helper::showData($data,$name[5])}}</textarea>
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                <a href="" onclick="history.back()" class="btn btn-default">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection
