@extends('app')
@section('content')
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
                <div class="form-group col-md-12">
                    <label for="">Nama</label>
                    <input type="text" class="form-control @error($name[0]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[0])}}" name="{{$name[0]}}" autocomplete="off" />
                </div>
                <div class="form-group col-md-12">
                    <label for="">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-envelope"></i></span>
                        </div>
                        <input type="email" name="{{$name[1]}}"  class="form-control @error($name[1]) is-invalid @enderror" value="{{Helper::showData($data,$name[1])}}" autocomplete="off" required>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="{{$name[2]}}"  class="form-control @error($name[2]) is-invalid @enderror" value="" autocomplete="off" required>
                    </div>
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
@push('library-js')

@endpush
