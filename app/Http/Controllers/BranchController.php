<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Bank;
use App\Branch;
use DB;
use Auth;

class BranchController extends Controller
{
    public function index(){
        $branches = Branch::select('id','name','code')
            ->orderBy('name')
            ->simplePaginate(10);
        
        $branches->appends(Request::all());
        return view('admin.utilities.branches.index',compact('branches'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'               =>  'required|unique:branches',
            'code'               =>  'required|unique:branches',
        ],
        [
            'name.required'      =>  'Branch Name Required',
            'code.required'      =>  'Branch Code Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Branch::create(Request::all());
        Alert::success('Success', 'Branch Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $branch = Branch::find($id);
        $validator = Validator::make(Request::all(), [
            'name'               =>  "required|unique:banks,name,$branch->id,id",
            'code'               =>  "required|unique:banks,code,$branch->id,id",
        ],
        [
            'name.required'      =>  'Branch Name Required',
            'code.required'      =>  'Branch Code Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $branch->update(Request::all());
        Alert::success('Success', 'Branch Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $branch = Branch::find($id);
        $branch->delete();
        Alert::success('Success', 'Branch Deleted Successfully');
        return redirect()->back();
    }
}
