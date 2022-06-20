<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Position;
use DB;
use Auth;

class PositionController extends Controller
{
    public function index(){
        $positions = Position::select('id','name')
            ->orderBy('name')
            ->simplePaginate(10);
        
        $positions->appends(Request::all());
        return view('admin.utilities.positions.index',compact('positions'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'               =>  'required|unique:positions',
        ],
        [
            'name.required'      =>  'Position Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Position::create(Request::all());
        Alert::success('Success', 'Position Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $position = Position::find($id);
        $validator = Validator::make(Request::all(), [
            'name'               =>  "required|unique:positions,name,$position->id,id",
        ],
        [
            'name.required'      =>  'Position Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $position->update(Request::all());
        Alert::success('Success', 'Position Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $position = Position::find($id);
        $position->delete();
        Alert::success('Success', 'Position Deleted Successfully');
        return redirect()->back();
    }
}
