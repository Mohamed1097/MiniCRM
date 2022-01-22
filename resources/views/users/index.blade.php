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
              @error('message')
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i>Message</h5>
               {{$message}}
              </div>
              @enderror
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Control</th>
                </tr>
                </thead>
                <tbody>
                    @isset($message)
                    <td colspan="7" class="text-center">
                      {{$message}}  
                    </td>  
                    @endisset
                    @foreach ($users as $user)
                    <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                      <a class="btn btn-info" href={{route("users.edit",['user'=>$user->id])}}>
                        <i class="fas fa-edit"></i>
                      </a>
                      @if (auth()->user()->id!=$user->id)
                      <button class="btn btn-danger delete-btn" type='submit' element={{$user->name}} data-toggle="modal" data-target='#delete-modal' url={{route('users.destroy',['user'=>$user->id])}}>
                        <i class="fas fa-trash"></i>
                      </button>
                    @endif
                    </td>
                    </tr>
                    @endforeach
                    
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Control</th>
                </tr>
                </tfoot>
              </table>
              <br>
              <div class="row" style="float:right;margin-right: 0%;">{{ $users->links('pagination::bootstrap-4') }}</div> 
              <a class="btn btn-primary" href={{route('users.create')}}>
                <i class="fas fa-plus"></i>
                <span>Add New User</span>
              </a>
            </div>
          </div>
    </section>
    
  @endsection