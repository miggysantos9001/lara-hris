<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Alert;
use DB;
use Auth;

class EmployeeController extends Controller
{
    public function index(){

    }

    public function create(){
        return view('admin.employees.create');
    }

    public function store(){

    }
}
