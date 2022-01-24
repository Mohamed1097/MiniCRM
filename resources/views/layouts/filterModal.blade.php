 
 <div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$title}} Filter</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @if (getUrl( url()->current(),'companies'))
        {!! Form::model($model,['route' => ['companies.index'],
        'method'=>'get'
        ]) !!}
            <div class="modal-body">
              <div class="form-group">
                <label>Company Name</label>
                {!! Form::text('name', null, ['class'=>'form-control','Placeholder'=>'Enter The Company Name']) !!}
              </div>
              <div class="form-group">
                <label>Company Email</label>
                {!! Form::text('email', null, ['class'=>'form-control','placeholder'=>'Enter The Company Email']) !!}
              </div>
            </div> 
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Filter</button>
              </div>
        {!! Form::close() !!}
        @else
        {!! Form::model($model,['route' => ['contacts.index'],
        'method'=>'get'
        ]) !!}
            <div class="modal-body">
              <div class="form-group">
                <label>First Name</label>
                {!! Form::text('first_name', null, ['class'=>'form-control','Placeholder'=>'Enter The Contact First Name']) !!}
              </div>
              <div class="form-group">
                <label>Last Name</label>
                {!! Form::text('last_name', null, ['class'=>'form-control','Placeholder'=>'Enter The Contact Last Name']) !!}
              </div>
              <div class="form-group">
                <label>Email</label>
                {!! Form::text('email', null, ['class'=>'form-control','Placeholder'=>'Enter The Contact Email']) !!}
              </div>
              <div class="form-group">
                <label>Phone</label>
                {!! Form::text('phone', null, ['class'=>'form-control','Placeholder'=>'Enter The Contact Phone']) !!}
              </div>
              <div class="form-group">
                <label>Company</label>
                {!! Form::text('keyword', null, ['class'=>'form-control','Placeholder'=>'Enter The Company Name Or Email']) !!}
              </div>
            </div> 
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Filter</button>
              </div>
        {!! Form::close() !!}
        
        @endif
        
        </div>
      </div>
    </div>
  </div>