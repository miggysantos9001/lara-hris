<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Sanction;
use DB;
use Auth;

class SanctionController extends Controller
{
    public function index(){
        $sanctions = Sanction::select('id','name')
            ->orderBy('name')
            ->simplePaginate(10);
        
        $sanctions->appends(Request::all());
        return view('admin.utilities.sanctions.index',compact('sanctions'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'               =>  'required|unique:sanctions',
        ],
        [
            'name.required'      =>  'Sanction Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Sanction::create(Request::all());
        Alert::success('Success', 'Sanction Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $sanction = Sanction::find($id);
        $validator = Validator::make(Request::all(), [
            'name'               =>  "required|unique:sanctions,name,$sanction->id,id",
        ],
        [
            'name.required'      =>  'Sanction Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $sanction->update(Request::all());
        Alert::success('Success', 'Sanction Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $sanction = Sanction::find($id);
        $sanction->delete();
        Alert::success('Success', 'Sanction Deleted Successfully');
        return redirect()->back();
    }
}
