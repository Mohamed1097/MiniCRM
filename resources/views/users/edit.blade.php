@extends('layouts.app')
@inject('model','App\Models\user' )
@section('content')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{$title}}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    {!! Form::model($model,[
        'url'=>url(route('users.update',['user'=>$user->id])),
        'method'=>'PUT'
        ]) !!}
        {!! Form::hidden('id',$user->id) !!}
    <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Name</label>
          <br>
          {!! Form::text('name', $user->name, ['class'=>'form-control','placeholder'=>'Enter The User Name']) !!}
          @error('name')
          <small style="color: #dc3545">{{ $message }}</small> 
          @enderror
        </div> 
        @if ($user->id==auth()->user()->id)
        <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <br>
          {!! Form::email('email', $user->email, ['class'=>'form-control','placeholder'=>'Enter The User Email']) !!}
          @error('email')
          <small style="color: #dc3545">{{ $message }}</small> 
          @enderror
        </div> 
        @endif
         
  </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button class="btn btn-primary" type='submit'>{{$title}}</button>
      </div>
    {!! Form::close() !!}
  </div>
  @endsection