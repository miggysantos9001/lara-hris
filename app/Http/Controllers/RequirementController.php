<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Requirement;
use DB;
use Auth;

class RequirementController extends Controller
{
    public function index(){
        $requirements = Requirement::select('id','name')
            ->orderBy('name')
            ->simplePaginate(10);
        
        $requirements->appends(Request::all());
        return view('admin.utilities.requirements.index',compact('requirements'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'               =>  'required|unique:requirements',
        ],
        [
            'name.required'      =>  'Requirement Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Requirement::create(Request::all());
        Alert::success('Success', 'Requirement Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $requirement = Requirement::find($id);
        $validator = Validator::make(Request::all(), [
            'name'               =>  "required|unique:requirements,name,$requirement->id,id",
        ],
        [
            'name.required'      =>  'Requirement Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $requirement->update(Request::all());
        Alert::success('Success', 'Requirement Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $requirement = Requirement::find($id);
        $requirement->delete();
        Alert::success('Success', 'Requirement Deleted Successfully');
        return redirect()->back();
    }
}
