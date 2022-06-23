@extends('master')
@section('content')
    <div class="col-12">
        <div class="card planned_task">
            <div class="header">
                <h2>Employees Page</h2>
                <a href="{{ route('employees.create') }}" class="btn btn-primary mt-1"><i class="fa fa-plus"></i> New Entry</a>
            </div>
            <div class="body">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <div class="card">
                                <div class="header">
                                    <h2>Employee List</h2>
                                </div>
                                <div class="body">
                                    <table class="table table-condensed table-hover table-sm mb-0 c_list">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>   
                                                <th>Name</th>                                       
                                                <th class="text-center" width="100">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($employees as $employee)
                                            <tr>
                                                <td>
                                                    {{ $employee->emp_id }}
                                                </td>
                                                <td>
                                                    {{ $employee->FullName }}
                                                </td>
                                                <td class="text-center">                                            
                                                    <a class="btn btn-info btn-sm" title="Edit" href="{{ route('employees.edit',$employee->id) }}"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center">NO RECORDS</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    {{ $employees->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection