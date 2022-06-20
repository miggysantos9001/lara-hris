<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Violation;
use DB;
use Auth;

class ViolationController extends Controller
{
    public function index(){
        $violations = Violation::select('id','name')
            ->orderBy('name')
            ->simplePaginate(10);
        
        $violations->appends(Request::all());
        return view('admin.utilities.violations.index',compact('violations'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'               =>  'required|unique:violations',
        ],
        [
            'name.required'      =>  'Violation Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Violation::create(Request::all());
        Alert::success('Success', 'Violation Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $violation = Violation::find($id);
        $validator = Validator::make(Request::all(), [
            'name'               =>  "required|unique:violations,name,$violation->id,id",
        ],
        [
            'name.required'      =>  'Violation Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $violation->update(Request::all());
        Alert::success('Success', 'Violation Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $violation = Violation::find($id);
        $violation->delete();
        Alert::success('Success', 'Violation Deleted Successfully');
        return redirect()->back();
    }
}
