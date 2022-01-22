@extends('layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Main content -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <button type="button" class="btn btn-primary mr-3 mb-3" data-toggle="modal" data-target="#filter" style="float: right">
                Filter
              </button>
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Control</th>
                  </tr>
                  </thead>
                  <tbody>
                      @isset($message)
                      <td colspan="7" class="text-center">
                        {{$message}}  
                      </td>  
                      @endisset
                      @foreach ($companies as $company)
                      <tr>
                      <td>{{$company->id}}</td>
                      <td><a href="{{route('companies.show',['company'=>$company->id])}}">{{$company->name}}</a></td>
                      <td>{{$company->email}}</td>
                      <td><a href={{$company->website_url}} target='_blank'>@ {{$company->name}}</a></td>
                      <td>
                        <a class="btn btn-info" href={{route("companies.edit",['company'=>$company->id])}}>
                          <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger delete-btn" type='submit' element='{{$company->name}}' data-toggle="modal" data-target='#delete-modal' url={{route('companies.destroy',['company'=>$company->id])}}>
                          <i class="fas fa-trash"></i>
                        </button>
                      </td>
                      </tr>
                      @endforeach
                      
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Control</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              
              <br>
              <div class="row" style="float:right;margin-right: 0%;">{{ $companies->links('pagination::bootstrap-4') }}</div> 
              <a class="btn btn-primary" href={{route('companies.create')}}>
                <i class="fas fa-plus"></i>
                <span>Add New Company</span>
              </a>
            </div>
          </div>
    </section>
  @endsection
  @section('filter')
  @include('layouts.filterModal')
  @endsection