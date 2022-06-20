@extends('master')
@section('content')
    <div class="col-12">
        <div class="card planned_task">
            <div class="header">
                <h2>Students Page</h2>
                <a href="#" class="btn btn-primary mt-1"><i class="fa fa-plus"></i> New Entry</a>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <div class="card">
                                <div class="header">
                                    <h2>Students List</h2>
                                </div>
                                <div class="body">
                                    <table class="table table-condensed table-hover table-sm mb-0 c_list">
                                        <thead>
                                            <tr>
                                                <th>LRN</th>   
                                                <th>Name</th>                                     
                                                <th>Grade Level & Section | Year Level & Course</th>  
                                                <th width="100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <p class="c_name">#14344-5254</p>
                                                </td>
                                                <td>
                                                    <p class="c_name">Elementary</p>
                                                </td>
                                                <td>
                                                    <p class="c_name">Elementary</p>
                                                </td>
                                                <td>                                            
                                                    <button type="button" class="btn btn-info btn-sm" title="Edit" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>
                                                    <button type="button" data-type="confirm" class="btn btn-danger btn-sm js-sweetalert" title="Delete"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p class="c_name">#14344-5254</p>
                                                </td>
                                                <td>
                                                    <p class="c_name">Elementary</p>
                                                </td>
                                                <td>
                                                    <p class="c_name">Elementary</p>
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