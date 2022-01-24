@extends('layouts.app')
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{$title}}</h3>
    </div>
   
    {!! Form::model($model,['route' => ['users.store'],        
        ]) !!}
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'Enter The User Name']) !!}
            @error('name')
            <small style="color: #dc3545">{{ $message }}</small> 
            @enderror
          </div>
        <div class="form-group">
          <label for="display name">Email</label>
          {!! Form::text('email',null, ['class'=>'form-control','placeholder'=>'Enter The User Email']) !!}
          @error('email')
          <small style="color: #dc3545">{{ $message }}</small> 
          @enderror
      </div>
      <div class="form-group">
        <label for="display name">Password</label>
        {!! Form::password('password',['class'=>'form-control','placeholder'=>'Enter The Password']) !!}
        @error('password')
        <small style="color: #dc3545">{{ $message }}</small> 
        @enderror
    </div>
    <div class="form-group">
        <label for="display name">confirm Password</label>
        {!! Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Enter The Confirm Password']) !!}
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
