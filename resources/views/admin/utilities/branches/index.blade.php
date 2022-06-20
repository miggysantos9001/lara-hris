@extends('master')
@section('content')
    <div class="col-12">
        <div class="card planned_task">
            <div class="header">
                <h2>Branch Page</h2>
                @include('alert')
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="header">
                                <h2> New Branch</h2>
                            </div>
                            {!! Form::open(['method'=>'POST','action'=>'BranchController@store']) !!}
                            <div class="body">
                                <div class="col-12">
                                    <div class="form-group">
                                        {!! Form::label('Branch Name') !!}
                                        {!! Form::text('name',null,['class'=>'form-control form-control-sm']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Branch Code') !!}
                                        {!! Form::text('code',null,['class'=>'form-control form-control-sm']) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Entry</button>    
                                </div>        
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="table-responsive">
                            <div class="card">
                                <div class="header">
                                    <h2>Branch List</h2>
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
                                            @forelse($branches as $data)
                                            <tr>
                                                <td>
                                                    <p class="c_name">{{ $data->name }} <span class="badge badge-success m-l-10 hidden-sm-down">{{ $data->code }}</span></p>
                                                </td>
                                                <td>                                            
                                                    <button type="button" class="btn btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#edit{{ $data->id }}"><i class="fa fa-edit"></i></button>
                                                    <button type="button" data-type="confirm" class="btn btn-danger btn-sm js-sweetalert" title="Delete" data-toggle="modal" data-target="#delete{{ $data->id }}"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="2" class="text-center">NO ENTRY</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <ul class="pagination mt-2">{!! $branches->links() !!}</ul>
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
@foreach ($branches as $data)
<div class="modal fade" id="edit{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">Edit Entry</h4>
            </div>
            {!! Form::open(['method'=>'PATCH','action'=>['BranchController@update',$data->id]]) !!}
            <div class="modal-body">
                <div class="card">
                    <div class="body">
                        <div class="col-12">
                            <div class="form-group">
                                {!! Form::label('Branch Name') !!}
                                {!! Form::text('name',$data->name,['class'=>'form-control form-control-sm']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('Branch Code') !!}
                                {!! Form::text('code',$data->code,['class'=>'form-control form-control-sm']) !!}
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-power-off"></i> Close</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade" id="delete{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="largeModalLabel">Delete Entry</h4>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="body">
                        <div class="col-12">
                            <h3 class="text-center">Are you sure you want to delete this entry?</h3>
                            <div class="text-center" style="margin-top: -30px;">
                                <br><small style="color: red;">It might cause an error in the system</small>
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('branches.delete',$data->id) }}" class="btn btn-warning"><i class="fa fa-trash-o"></i> Delete Entry</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-power-off"></i> Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endpush