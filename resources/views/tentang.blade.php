@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
      <!-- Default box -->
                    
                    <div class="row justify-content-center">
                        <div class="col-5 col-xs-12 text-center d-flex align-items-center justify-content-center">
                            <div>
                                <img src="{{asset('admin\dist\img\Logo MDT.png')}}" class="mb-2" width="50%" alt="logo">
                            <h2>MDT<strong>Sirojul Athfal</strong></h2>
                            <p class="lead mb-3">Jl. Nagrak - Cibadak No.37 Desa Nagrak Selatan Kec.Nagrak Kab.Sukabumi 43356</p>
                                <img src="{{asset('admin\dist\img\slogan.png')}}" width="30%" alt="logo">
                            </div>
                        </div>
                    </div>
                  
        <!-- Default box --> 
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
@endsection