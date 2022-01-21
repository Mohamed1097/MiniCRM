@extends('layouts.app')
@inject('model','App\Models\Company' )
@section('content')
<div class="widget-user-image ml-1 mb-3 d-flex justify-content-center">
  <img class="img-circle elevation-2" style="width: 128px" height="128px" src={{asset('storage/'.$company->logo)}} >
</div>
<div class="card card-primary">
  
    <div class="card-header">
      <h3 class="card-title">{{$title}}</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
   
    {!! Form::model($model,['route' => ['companies.update','company'=>$company->id],
    'files' => true ,'method'=>'put'       
       ]) !!}
       <input type="hidden" value={{$company->id}} name='id' >
       <div class="card-body">
         <div class="form-group">
           <label for="name">Name</label>
           {!! Form::text('name',$company->name, ['placeholder'=>'Enter The Company Name','class'=>'form-control']) !!}
           @error('name')
           <small style="color: #dc3545">{{ $message }}</small> 
           @enderror
       </div>
       <div class="form-group">
         <label for="display name">Email</label>
         {!! Form::email('email',$company->email, ['placeholder'=>'Enter The Company Email','class'=>'form-control']) !!}
         @error('email')
         <small style="color: #dc3545">{{ $message }}</small> 
         @enderror
     </div>
     <div class="form-group">
       <label for="display name">Website</label>
       {!! Form::text('website_url',$company->website_url, ['placeholder'=>'Enter The Company Website','class'=>'form-control']) !!}
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