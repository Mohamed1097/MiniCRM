@extends('layouts.app')
<!-- Content Wrapper. Contains page content -->
@section('content')
    <!-- Main content -->
    <div class="widget-user-image ml-1 mb-3 d-flex justify-content-center">
      <img class="img-circle elevation-2" style="width: 128px" height="128px" src={{asset('storage/'.$company->logo)}} >
    </div>
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                      <tr>
                      <td>{{$company->id}}</td>
                      <td>{{$company->name}}</td>
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
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$title}} Contacts</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>phone</th>
                    <th>Company</th>
                    <th>Linkdin</th>
                    <th>Control</th>
                  </tr>
                  </thead>
                  <tbody>
                      @isset($message)
                      <td colspan="7" class="text-center">
                        {{$message}}  
                      </td>  
                      @endisset
                      @foreach ($contacts as $contact)
                      <tr>
                      <td>{{$contact->id}}</td>
                      <td>{{$contact->full_name}}</td>
                      <td>{{$contact->email}}</td>
                      <td>{{$contact->phone}}</td>
                      <td>{{$contact->company->name}}</td>
                      <td>@if ($contact->linkdin_profile_url!=null)
                          <a href={{$contact->linkdin_profile_url}} target='_blank'>@ {{$contact->full_name}}</a>
                      @else
                          There Is no Linkdin Profile
                      @endif</td>
                      <td>
                        <a class="btn btn-info" href={{route("contacts.edit",['contact'=>$contact->id])}}>
                          <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger delete-btn" type='submit' element='{{$contact->full_name}}' data-toggle="modal" data-target='#delete-modal' url={{route('contacts.destroy',['contact'=>$contact->id])}}>
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
                    <th>phone</th>
                    <th>Company</th>
                    <th>Linkdin</th>
                    <th>Control</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              
              <br>
              <div class="row" style="float:right;margin-right: 0%;">{{ $contacts->links('pagination::bootstrap-4') }}</div> 
             
              </a>
            </div>
          </div>
          
    </section>
  @endsection

  