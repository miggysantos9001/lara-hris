<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Bank;
use DB;
use Auth;

class BankController extends Controller
{
    public function index(){
        $banks = Bank::select('id','name','code')
            ->orderBy('name')
            ->simplePaginate(10);
        
        $banks->appends(Request::all());
        return view('admin.utilities.banks.index',compact('banks'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'               =>  'required|unique:banks',
            'code'               =>  'required|unique:banks',
        ],
        [
            'name.required'      =>  'Bank Name Required',
            'code.required'      =>  'Bank Code Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Bank::create(Request::all());
        Alert::success('Success', 'Bank Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $bank = Bank::find($id);
        $validator = Validator::make(Request::all(), [
            'name'               =>  "required|unique:banks,name,$bank->id,id",
            'code'               =>  "required|unique:banks,code,$bank->id,id",
        ],
        [
            'name.required'      =>  'Bank Name Required',
            'code.required'      =>  'Bank Code Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $bank->update(Request::all());
        Alert::success('Success', 'Bank Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $bank = Bank::find($id);
        $bank->delete();
        Alert::success('Success', 'Bank Deleted Successfully');
        return redirect()->back();
    }
}
