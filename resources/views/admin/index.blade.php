@extends('app')
<style>
    #gmap_canvas,.gmap_canvas,.mapouter{
        width: 100% !important;
        
    }
</style>
@php
    $setting = App\Models\MProfilApp::first();
@endphp
@section('content')
<center>
    <h1>SELAMAT DATANG</h1>
    <h6>Di Aplikasi {{$setting->nama}} </h6>
    
</center>
@endsection