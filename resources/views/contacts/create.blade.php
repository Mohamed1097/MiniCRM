@extends('layouts.app')
@section('content')
@inject('model','App\Models\ContactPerson')
@inject('companies','App\Models\Company')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">{{$title}}</h3>
    </div>
   
    {!! Form::model($model,['route' => ['contacts.store'],
        ]) !!}
        <div class="card-body">
          <div class="form-group">
            <label for="name">First Name</label>
            {!! Form::text('first_name', null, ['placeholder'=>'Enter The First Name','class'=>'form-control']) !!}
            @error('first_name')
            <small style="color: #dc3545">{{ $message }}</small> 
            @enderror
        </div>
        <div class="form-group">
          <label for="name">Last Name</label>
          {!! Form::text('last_name', null, ['placeholder'=>'Enter The Last Name','class'=>'form-control']) !!}
          @error('last_name')
          <small style="color: #dc3545">{{ $message }}</small> 
          @enderror
      </div>
        <div class="form-group">
          <label for="display name">Email</label>
          {!! Form::email('email',null, ['placeholder'=>'Enter The Contact Email','class'=>'form-control']) !!}
          @error('email')
          <small style="color: #dc3545">{{ $message }}</small> 
          @enderror
      </div>
      <div class="form-group">
        <label for="display name">Phone</label>
        {!! Form::text('phone',null, ['placeholder'=>'Enter The Contact Phone','class'=>'form-control']) !!}
        @error('phone')
        <small style="color: #dc3545">{{ $message }}</small> 
        @enderror
    </div>
    <div class="form-group">
      <label for="display name">Company</label>
      {!! Form::select('company_id',$companies->pluck('name','id')->toArray(),null, ['class'=>'form-control','placeholder'=>'Select The Company']) !!}
      @error('company_id')
      <small style="color: #dc3545">{{ $message }}</small> 
      @enderror
  </div>
  <div class="form-group">
    <label for="display name">Linkdin</label>
    <br>
    {!! Form::checkbox(null,null,null, ['checked'=>false ,'class'=>'linkdin']) !!}
    {!! Form::text('linkdin_profile_url',null, ['placeholder'=>'Enter The Contact Linkdin','class'=>'form-control','disabled'=>true]) !!}
    @error('linkdin_profile_url')
    <small style="color: #dc3545">{{ $message }}</small> 
    @enderror
</div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">{{$title}}</button>
        </div>
        {!! Form::close() !!}
  </div>
  @push('custom-scripts')
    
  @endpush
  @endsection
