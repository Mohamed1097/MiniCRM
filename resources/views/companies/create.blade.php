@extends('layouts.app')
@section('content')
@inject('model','App\Models\Company' )
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{$title}}</h3>
    </div>
   
    {!! Form::model($model,['route' => ['companies.store'],
     'files' => true        
        ]) !!}
        <div class="card-body">
          <div class="form-group">
            <label for="name">Name</label>
            {!! Form::text('name', null, ['placeholder'=>'Enter The Company Name','class'=>'form-control']) !!}
            @error('name')
            <small style="color: #dc3545">{{ $message }}</small> 
            @enderror
        </div>
        <div class="form-group">
          <label for="display name">Email</label>
          {!! Form::email('email',null, ['placeholder'=>'Enter The Company Email','class'=>'form-control']) !!}
          @error('email')
          <small style="color: #dc3545">{{ $message }}</small> 
          @enderror
      </div>
      <div class="form-group">
        <label for="display name">Website</label>
        {!! Form::text('website_url',null, ['placeholder'=>'Enter The Company Website','class'=>'form-control']) !!}
        @error('website_url')
        <small style="color: #dc3545">{{ $message }}</small> 
        @enderror
    </div>
    <div class="form-group">
      <label for="display name">Logo</label>
      {!! Form::file('logo', ['accept'=>'image/*','class'=>'form-control-file']) !!}
      @error('logo')
      <small style="color: #dc3545">{{ $message }}</small> 
      @enderror
  </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">{{$title}}</button>
        </div>
        {!! Form::close() !!}
  </div>
  @endsection
