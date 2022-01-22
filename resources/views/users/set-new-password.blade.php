@extends('layouts.app')
@section('content')
@inject('model', 'App\Models\User')
<div class="card card-primary">
  @error('message')
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-check"></i>Message</h5>
               {{$message}}
              </div>
              @enderror
    <div class="card-header">
      <h3 class="card-title">{{$title}}</h3>
    </div>
    `  {!! Form::model($model, ['route'=>['set-new-password']]) !!}
      <div class="card-body">
        <div class="form-group">
            <label for="current-password">Current Password</label>
            {!! Form::password('current_password', ['class'=>'form-control','placeholder'=>'Enter The Current Password']) !!}
            @error('current_password')
            <small style="color: #dc3545">{{ $message }}</small> 
            @enderror
        </div>
        <div class="form-group">
          <label for="Password">New Password</label>
          {!! Form::password('password', ['class'=>'form-control','placeholder'=>'Enter The New Password']) !!}
          @error('Password')
          <small style="color: #dc3545">{{ $message }}</small> 
          @enderror
        </div>
       <div class="form-group">
          <label for="password_confirmation">confirm Password</label>
          {!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Enter The Confirm Password']) !!}
          @error('password')
          <small style="color: #dc3545">{{ $message }}</small> 
          @enderror
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">{{$title}}</button>
      </div>
      {!! Form::close() !!}
</div>
@endsection
