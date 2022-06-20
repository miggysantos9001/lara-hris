@extends('master')
@section('content')
    <div class="col-12">
        <div class="card planned_task">
            <div class="header">
                <h2>Leave Page</h2>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="header">
                                <h2> New Leave</h2>
                            </div>
                            <div class="body">
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::label('Leave Name') !!}
                                        {!! Form::text('',null,['class'=>'form-control form-control-sm']) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Entry</button>    
                                </div>        
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="table-responsive">
                            <div class="card">
                                <div class="header">
                                    <h2>Leave List</h2>
                                </div>
                                <div class="body">
                                    <table class="table table-condensed table-hover table-sm mb-0 c_list">
                                        <thead>
                                            <tr>
                                                <th>Name</th>                                     
                                                <th width="100">Action</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <p class="c_name">Leave 1</p>
                                                </td>
                                                <td>                                            
                                                    <button type="button" class="btn btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                                                    <button type="button" data-type="confirm" class="btn btn-danger btn-sm js-sweetalert" title="Delete"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modals')
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">Edit Entry</h4>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="body">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('Leave Name') !!}
                                {!! Form::text('',null,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-power-off"></i> Close</button>
            </div>
        </div>
    </div>
</div>
@endpush