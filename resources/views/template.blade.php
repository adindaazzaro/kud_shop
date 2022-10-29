@extends('app')
@section('content')
<link rel="stylesheet" href="{{asset('/')}}assets/plugins/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="{{asset('/')}}assets/plugins/summernote/summernote-bs4.min.css">
<link rel="stylesheet" href="{{asset('/')}}assets/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{asset('/')}}assets/plugins/izitoast/css/iziToast.min.css">
<link rel="stylesheet" href="{{asset('/')}}assets/plugins/jquery-multiple-upload-image/dist/image-uploader.min.css">
<link rel="stylesheet" href="{{asset('/')}}assets/plugins/ekko-lightbox/ekko-lightbox.css">
<link rel="stylesheet" href="{{asset('/')}}assets/plugins/sweetalert2/sweetalert2.min.css">

    

<?php

use App\Traits\Helper;

$name[] = 'name';
$name[] = 'email';
$name[] = 'password';

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
                {{-- text --}}
                <div class="form-group col-md-12">
                    <label for="">Nama</label>
                    <input type="text" class="form-control @error($name[0]) is-invalid @enderror" value="{{Helper::showData($data,$name[0])}}" name="{{$name[0]}}" autocomplete="off" />
                </div>
                {{-- email --}}
                <div class="form-group col-md-12">
                    <label for="">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input type="email" name="{{$name[1]}}" class="form-control @error($name[1]) is-invalid @enderror" value="{{Helper::showData($data,$name[1])}}" autocomplete="off" required>
                    </div>
                </div>
                {{-- password --}}
                <div class="form-group col-md-12">
                    <label for="">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="{{$name[2]}}" class="form-control @error($name[2]) is-invalid @enderror" value="" autocomplete="off" required>
                    </div>
                </div>
                {{-- select basic --}}
                <div class="form-group col-md-6">
                    <label for="exampleInputEmail1">Jenis Kelamin</label>
                    <select id="tipe" class="form-control @error($name[4]) is-invalid @enderror"
                        name="{{$name[4]}}" autocomplete="off">
                        <option value="" selected disabled> Pilih Jenis Kelamin</option>

                        <option value="L" {{(old($name[4]) == "L") ? 'selected' : ''}}
                            {{Helper::showDataSelected2($data,$name[4],"L")}}>
                            Laki - Laki
                        </option>
                        <option value="P" {{(old($name[4]) == "P") ? 'selected' : ''}}
                            {{Helper::showDataSelected2($data,$name[4],"P")}}>
                            Perempuan
                        </option>
                    </select>
                </div>
                {{-- select with data --}}
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Kelas</label>
                    <select id="kelas" class="form-control @error($name[6]) is-invalid @enderror"
                        name="{{$name[6]}}" autocomplete="off">
                        <option value="" selected disabled> Pilih Kelas</option>

                        @foreach($kelas as $key)
                        <option value="<?= $key->{$name[6]} ?>"
                            {{(old($name[6]) == $key->{$name[6]}) ? 'selected' : ''}}
                            {{Helper::showDataSelected($data,$name[6],$key->{$name[6]})}}>
                            {{$key->nama." ".$key->jurusan->nama}}
                        </option>
                        @endforeach
                        
                    </select>
                </div>
                {{-- textarea --}}
                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Alamat</label>
                    <textarea type="text" class="form-control @error($name[7]) is-invalid @enderror" cols="5"
                        rows="6" style="height:100px" value="" name="{{$name[7]}}"
                        autocomplete="off">{{Helper::showData($data,$name[7])}}</textarea>
                </div>
                {{-- --------------------------------------Advanced Form------------------------------------------------ --}}
                {{-- Phone --}}
                <div class="form-group">
                    <label for="">No Telepon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+62</span>
                        </div>
                        <input type="text" name="no_telp" class="form-control" value="{{$data->no_telp}}" data-inputmask='"mask": "999-9999-9999"' placeholder="___-____-____" data-mask required>
                    </div>
                </div>
                {{-- image live --}}
                <div class="row">
                    <div class="col">
                        <label for="">Logo App</label>
                        <div class="image-live" data-target="logo" data-ext="png,jpg,jpeg">
                            <input type="file" class="d-none file-live" name="logo">
                            <input type="file" class="d-none" value="{{$data->logo}}" name="logo-old">
                            @if($data->logo != null)
                            <img id="logo" src="{{asset('image/setting/'.$data->logo)}}"  style="width: 100px; height:100px" class="rounded-circle shadow mb-4 img-fluid" alt="" srcset="">
                            @else
                            <img id="logo" src="{{asset('assets/dist/img/default-150x150.png')}}"  style="width: 100px; height:100px" class="rounded-circle shadow mb-4 img-fluid" alt="" srcset="">
                            @endif
                        </div>
                        <div class="text-danger mb-4"><small><i>File Tidak Boleh Lebih besar dari 1Mb</i></small></div>
                    </div>
                </div>
                {{-- multipe upload image --}}
                <div class="input-images" style="padding-top: .5rem;"></div>
                {{-- multiple input --}}
                <div class="row">
                    <div class="col data">
                        <div class="input-group mb-3">
                            <input type="text" name="vidio[]" class="form-control" value="{{$vidio['nama_file']}}" placeholder="Masukkan Kode Vidio Youtube disini">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger btn-add-multiple-input" ><i class="fas fa-times-circle"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 position-relative">
                        <button type="button" class="btn btn-success position-absolute mb-3 btn-add-field-vidio" style="bottom:0;height: 38px;"><i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
                {{-- multiple select --}}
                <div class="form-group">
                    <label>Siswa</label>
                    <select id="siswa" class="form-control multiple-select" placeholer="">
                        @foreach(MSiswa::all() as $key)
                            <option value="{{encrypt($key->id_siswa)}}">{{$key->nisn." - ".$key->nama}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- numeric --}}
                <div class="form-group">
                    <label>Nominal</label>
                    <input type="text" name="biaya" class="form-control numeric" required="" autocomplete="off">
                </div>
                {{-- --------------------------------------Advanced Form End------------------------------------------------ --}}
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                <a href="" onclick="history.back()" class="btn btn-default">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection
{{-- img - live --}}
<script type="text/javascript" src="{{asset('/')}}assets/dist/js/custom.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/dist/js/image-live.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/dist/js/multiple-input.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/plugins/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/plugins/summernote/summernote-bs4.min.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/plugins/izitoast/js/iziToast.min.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/plugins/jquery-multiple-upload-image/dist/image-uploader.min.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script type="text/javascript" src="{{asset('/')}}assets/plugins/autonumeric/autoNumeric.js')}}"></script>

<script>
    $('[data-mask]').inputmask();
    $('.input-images').imageUploader();
    $('.multiple-select').select2({
        placeholder: "Placeholder",
    }).val("").trigger("change");
    $(".multiple-select").select2("val", "");
    setNumeric();
</script>