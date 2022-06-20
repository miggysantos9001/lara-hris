<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use App\Category;
use DB;
use Auth;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::select('id','name')
            ->orderBy('name')
            ->simplePaginate(10);
        
        $categories->appends(Request::all());
        return view('admin.utilities.categories.index',compact('categories'));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'name'               =>  'required|unique:categories',
        ],
        [
            'name.required'      =>  'Category Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Category::create(Request::all());
        Alert::success('Success', 'Category Created Successfully');
        return redirect()->back();
    }

    public function update($id){
        $category = Category::find($id);
        $validator = Validator::make(Request::all(), [
            'name'               =>  "required|unique:categories,name,$category->id,id",
        ],
        [
            'name.required'      =>  'Category Name Required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category->update(Request::all());
        Alert::success('Success', 'Category Updated Successfully');
        return redirect()->back();
    }

    public function delete($id){
        $category = Category::find($id);
        $category->delete();
        Alert::success('Success', 'Category Deleted Successfully');
        return redirect()->back();
    }
}
