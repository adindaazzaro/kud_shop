@extends('app')
@section('content')
<?php
use App\Traits\Helper;

$name[] = 'nama';
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
            @if(!$create)
                <input type="hidden" name="id" value="{{$data->id}}">
            @endif
            <input type="hidden" name="id_kustomer" value="{{$id_kustomer}}">

            <div class="row">

                <div class="form-group col-md-12">
                    <label for="">Nama</label>
                    <input type="text" class="form-control @error($name[0]) is-invalid @enderror"
                        value="{{Helper::showData($data,$name[0])}}" name="{{$name[0]}}" autocomplete="off" />
                </div>

                <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Alamat</label>
                    <textarea id="{{$name[1]}}" type="text" class="form-control @error($name[1]) is-invalid @enderror" cols="5"
                        rows="6" style="height:100px" name="{{$name[1]}}"
                        autocomplete="off">{{Helper::showData($data,$name[1])}}</textarea>
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
