<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Category;
use App\Department;
use DB;
use Auth;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Department::select('id','name')
            ->orderBy('name')
            ->simplePaginate(10);
        
        $departments->appends(Request::all());
        return view('admin.utilities.departments.index',compact('departments'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'               =>  'required|unique:departments',
        ],
        [
            'name.required'      =>  'Department Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Department::create(Request::all());
        Alert::success('Success', 'Department Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $department = Department::find($id);
        $validator = Validator::make(Request::all(), [
            'name'               =>  "required|unique:departments,name,$department->id,id",
        ],
        [
            'name.required'      =>  'Department Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $department->update(Request::all());
        Alert::success('Success', 'Department Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $department = Department::find($id);
        $department->delete();
        Alert::success('Success', 'Department Deleted Successfully');
        return redirect()->back();
    }
}
