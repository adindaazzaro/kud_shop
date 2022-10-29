
<!DOCTYPE html>
<html lang="en">
{{-- Header --}}
@php
    $setting = App\Models\MProfilApp::first();
@endphp
@include("panels.header")
@stack("library-style")
<style>
    .select2-container--default .select2-selection--single {
        height: calc(2.25rem + 2px) !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100% !important;
    }
</style>
{{-- end header --}}
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="progress" style="height: 5px;position:fixed;top:0;z-index:99999;width:100%;display:none;">
        <div id="progress" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center" style="opacity: .7;">
            <img class="animation__shake" src="{{asset('image/setting/'.$setting->logo)}}" alt="{{$setting->nama}}" height="60"
                width="60">
        </div>
        @include('panels.navbar')

        @include('panels.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->

            <!-- /.content -->
        </div>

        @include("panels/footer")
    </div>
    <!-- ./wrapper -->

    @include("panels.scripts")
    @stack("library-js")
    @stack('js')
</body>

</html>