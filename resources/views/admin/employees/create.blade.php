@extends('master')
@section('content')
    <div class="col-12">
        <div class="card planned_task">
            <div class="header">
                <h2>Employees Page</h2>
                @include('alert')
            </div>
            <div class="body">
                <ul class="nav nav-tabs">                                
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Settings">Personal Information</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#billings">Employee Information</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#preferences">Salary Information</a></li>
                </ul>
            </div>
            {!! Form::open(['method'=>'POST','action'=>'EmployeeController@store','files' => true]) !!}
            <div class="tab-content">
                <div class="tab-pane active" id="Settings">
                    <div class="body">
                        <h6>Profile Photo</h6>
                        <div class="media">
                            <div class="media-left m-r-15">
                                {{-- <img src="{{ asset('public/assets/images/user.png') }}" class="user-photo media-object" alt="User"> --}}
                                <img id="previewHolder" src="{{ asset('public/assets/images/user.png') }}" alt="Upload Photo" width="140px" height="140px" class=""/>
                            </div>
                            <div class="media-body">
                                <p>Upload your photo.<span style="color:red;">*</span></p>
                                <input type="file" name="photo" value="" id="photo" class="form-control borrowerImageFile" data-errormsg="PhotoUploadErrorMsg">
                            </div>
                        </div>
                    </div>

                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group"> 
                                    {!! Form::label('Employee ID #') !!}<span style="color:red;">*</span>    
                                    {!! Form::text('emp_id',null,['class'=>'form-control form-control-sm']) !!}       
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Last Name') !!}<span style="color:red;">*</span>    
                                    {!! Form::text('lastname',null,['class'=>'form-control form-control-sm']) !!}      
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('First Name') !!}<span style="color:red;">*</span>                                               
                                    {!! Form::text('firstname',null,['class'=>'form-control form-control-sm']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Middle Name') !!}                                               
                                    {!! Form::text('middlename',null,['class'=>'form-control form-control-sm']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Ext Name') !!}                                               
                                    {!! Form::text('extname',null,['class'=>'form-control form-control-sm']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Address') !!}<span style="color:red;">*</span>                                               
                                    {!! Form::text('address',null,['class'=>'form-control form-control-sm']) !!} 
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group"> 
                                    {!! Form::label('Email Address') !!} <span style="color:red;">*</span>                                              
                                    {!! Form::text('email',null,['class'=>'form-control form-control-sm']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Contact #') !!}<span style="color:red;">*</span>                                               
                                    {!! Form::text('mobile',null,['class'=>'form-control form-control-sm']) !!} 
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Gender') !!}<span style="color:red;">*</span>
                                    <div>
                                        <label class="fancy-radio">
                                            <input name="gender" value="male" type="radio" checked="checked">
                                            <span><i></i>Male</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input name="gender" value="female" type="radio">
                                            <span><i></i>Female</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('Birthdate') !!}<span style="color:red;">*</span>
                                    {!! Form::date('birthdate',null,['class'=>'form-control form-control-sm']) !!}
                                </div>
                                <div class="form-group">    
                                    {!! Form::label('Birthplace') !!}<span style="color:red;">*</span>                                            
                                    {!! Form::text('birthplace',null,['class'=>'form-control form-control-sm']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Civil Status') !!}<span style="color:red;">*</span>    
                                    {!! Form::select('civil_status',['SINGLE'=>'SINGLE','MARRIED'=>'MARRIED','WIDOWER'=>'WIDOWER'],null,['class'=>'select2 form-control','placeholder'=>'-- Select One --','style'=>'width:100%;']) !!}   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="billings">
                    
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group"> 
                                    {!! Form::label('Date Hired') !!}    
                                    {!! Form::date('date_hired',null,['class'=>'form-control form-control-sm']) !!}       
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Date Separated') !!}    
                                    {!! Form::date('date_separated',null,['class'=>'form-control form-control-sm']) !!}       
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Department') !!}    
                                    {!! Form::select('department_id',$departments,null,['class'=>'select2 form-control form-control-sm','placeholder'=>'-- Select One --','style'=>'width:100%;']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Position') !!}    
                                    {!! Form::select('position_id',$positions,null,['class'=>'select2 form-control form-control-sm','placeholder'=>'-- Select One --','style'=>'width:100%;']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Official Time - In') !!}    
                                    {!! Form::time('time_in',null,['class'=>'form-control form-control-sm']) !!}       
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Official Time - Out') !!}    
                                    {!! Form::time('time_out',null,['class'=>'form-control form-control-sm']) !!}       
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div style="margin-top: 6px;"></div>
                                <div class="form-group"> 
                                    {!! Form::label('Branch') !!}    
                                    {!! Form::select('branch_id',$branches,null,['class'=>'select2 form-control form-control-sm','placeholder'=>'-- Select One --','style'=>'width:100%;']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Employment Category') !!}    
                                    {!! Form::select('category_id',$categories,null,['class'=>'select2 form-control form-control-sm','placeholder'=>'-- Select One --','style'=>'width:100%;']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Employment Status') !!}    
                                    {!! Form::select('status_id',$status,null,['class'=>'select2 form-control form-control-sm','placeholder'=>'-- Select One --','style'=>'width:100%;']) !!} 
                                </div>
                                <div class="form-group"> 
                                    {!! Form::label('Restday') !!}    
                                    {!! Form::select('restday_id[]',$weekdays,null,['class'=>'select2 form-control form-control-sm','multiple','style'=>'width:100%;']) !!} 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="preferences">
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group"> 
                                            {!! Form::label('Bank') !!}    
                                            {!! Form::select('bank_id',$banks,null,['class'=>'select2 form-control form-control-sm','placeholder'=>'-- Select One --','style'=>'width:100%;']) !!} 
                                        </div>
                                        <div class="form-group"> 
                                            {!! Form::label('Account #') !!}    
                                            {!! Form::text('account_number',null,['class'=>'form-control form-control-sm']) !!} 
                                        </div>
                                        <div class="form-group"> 
                                            {!! Form::label('Salary') !!}    
                                            {!! Form::text('salary','0.00',['class'=>'form-control form-control-sm']) !!} 
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div style="margin-top: 6px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Entry</button>
                <a href="{{ route('employees.index') }}" class="btn btn-secondary"><i class="fa fa-home"></i> Back to Index</a>
            </div>
            {!! Form::close() !!}
        </div>   
    </div>
@endsection
@push('js')
<script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#previewHolder').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      } else {
        alert('select a file to see preview');
        $('#previewHolder').attr('src', '');
      }
    }

    $("#photo").change(function() {
      readURL(this);
    });
</script>
@endpush