@extends('layouts.app')
@inject('companies','App\Models\Company')
@inject('contacts','App\Models\ContactPerson')
<!-- Content Wrapper. Contains page content -->
@section('content')
  
    <!-- Content Header (Page header) -->

    <!-- Main content -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                  <span class="info-box-icon bg-info"><i class="fas fa-industry"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Companies</span>
                    <span class="info-box-number">{{$companies->count()}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box">
                  <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text">Contacts</span>
                    <span class="info-box-number">{{$contacts->count()}}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              
        </div>
      <!-- /.card -->

  <!-- /.content-wrapper -->
  @endsection