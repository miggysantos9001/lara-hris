<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Category;
use App\Employee_status;
use DB;
use Auth;

class EmployeeStatusController extends Controller
{
    public function index(){
        $status = Employee_status::select('id','name')
            ->orderBy('name')
            ->simplePaginate(10);
        
        $status->appends(Request::all());
        return view('admin.utilities.employee-status.index',compact('status'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'               =>  'required|unique:employee_statuses',
        ],
        [
            'name.required'      =>  'Status Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Employee_status::create(Request::all());
        Alert::success('Success', 'Status Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $status = Employee_status::find($id);
        $validator = Validator::make(Request::all(), [
            'name'               =>  "required|unique:employee_statuses,name,$status->id,id",
        ],
        [
            'name.required'      =>  'Status Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $status->update(Request::all());
        Alert::success('Success', 'Status Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $status = Employee_status::find($id);
        $status->delete();
        Alert::success('Success', 'Status Deleted Successfully');
        return redirect()->back();
    }
}
