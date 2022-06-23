<?php

namespace App\Http\Controllers;

use Validator;
use Request;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Alert;
use App\Bank;
use App\Branch;
use App\Category;
use App\Department;
use App\Employee;
use App\Employee_geninfo;
use App\Employee_restday;
use App\Employee_salaryinfo;
use App\Employee_schedule;
use App\Employee_status;
use App\Position;
use App\Weekday;
use DB;
use Auth;

class EmployeeController extends Controller
{
    public function index(){
        $employees = Employee::with('emp_geninfo','emp_salinfo','emp_schedule','emp_restday')
            ->orderBy('lastname')
            ->paginate(10);
        
        return view('admin.employees.index',compact('employees'));
    }

    public function create(){
        $departments = Department::orderBy('name')->get()->pluck('name','id');
        $positions = Position::orderBy('name')->get()->pluck('name','id');
        $branches = Branch::orderBy('name')->get()->pluck('name','id');
        $categories = Category::orderBy('name')->get()->pluck('name','id');
        $status = Employee_status::orderBy('name')->get()->pluck('name','id');
        $banks = Bank::orderBy('name')->get()->pluck('name','id');
        $weekdays = Weekday::orderBy('id')->get()->pluck('name','id');
        return view('admin.employees.create',compact(
            'departments','positions','branches','categories','status',
            'banks','weekdays'
        ));
    }

    public function store(){
        $validator = Validator::make(Request::all(), [
            'emp_id'            =>  'required|unique:employees',
            'lastname'          =>  'required',
            'firstname'         =>  'required',
            'birthdate'         =>  'required',
            'birthplace'        =>  'required',
            'gender'            =>  'required',
            'address'           =>  'required',
            'mobile'            =>  'required',
            'email'             =>  'required|unique:employees',
            'photo'             =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_hired'        =>  'required',
            'department_id'     =>  'required',
            'branch_id'         =>  'required',
            'category_id'       =>  'required',
            'status_id'         =>  'required',
            'position_id'       =>  'required',
            'time_in'           =>  'required',
            'time_out'          =>  'required',
            'bank_id'           =>  'required',
            'restday_id'        =>  "required|array|min:1",
        ],
        [
            'emp_id.required'           =>  'Emp ID Required',
            'lastname.required'         =>  'Last Name Required',
            'firstname.required'        =>  'First Name Required',
            'birthdate.required'        =>  'Birthdate Required',
            'gender.required'           =>  'Please Select Gender',
            'address.required'          =>  'Address Required',
            'mobile.required'           =>  'Contact # Required',
            'email.required'            =>  'Email Address Required',
            'photo.required'            =>  'Please Upload Image',
            'date_hired.required'       =>  'Date Hired Required',
            'department_id.required'    =>  'Please Select Department',
            'branch_id.required'        =>  'Please Select Branch',
            'category_id.required'      =>  'Please Select Category',
            'status_id.required'        =>  'Please Select Employee Status',
            'position_id.required'      =>  'Please Select Position',
            'bank_id.required'          =>  'Please Select Bank',
            'time_in.required'          =>  'Time-in Required',
            'time_out.required'         =>  'Time-out Required',
            'restday_id.required'       =>  'Please Select Restday',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $file = Request::file('photo');

        $extension = $file->getClientOriginalExtension();
        $fileName = Str::random(50).'.'.$extension;
        $file->move(public_path().'/photo',$fileName);

        $employee_id = Employee::create([
            'emp_id'        =>      Request::get('emp_id'),
            'lastname'      =>      Request::get('lastname'),
            'firstname'     =>      Request::get('firstname'),
            'middlename'    =>      Request::get('middlename'),
            'extname'       =>      Request::get('extname'),
            'address'       =>      Request::get('address'),
            'gender'        =>      Request::get('gender'),
            'email'         =>      Request::get('email'),
            'mobile'        =>      Request::get('mobile'),
            'birthdate'     =>      Request::get('birthdate'),
            'birthplace'    =>      Request::get('birthplace'),
            'civil_status'  =>      Request::get('civil_status'),
            'photo'         =>      $fileName,
        ])->id;

        Employee_geninfo::create([
            'employee_id'       =>      $employee_id,
            'date_hired'        =>      Request::get('date_hired'),
            'date_separated'    =>      Request::get('date_separated'),
            'department_id'     =>      Request::get('department_id'),
            'position_id'       =>      Request::get('position_id'),
            'branch_id'         =>      Request::get('branch_id'),
            'category_id'       =>      Request::get('category_id'),
            'status_id'         =>      Request::get('status_id'),
        ]);

        Employee_salaryinfo::create([
            'employee_id'       =>      $employee_id,
            'bank_id'           =>      Request::get('bank_id'),
            'account_number'    =>      Request::get('account_number'),
            'salary'            =>      Request::get('salary'),
        ]);

        Employee_schedule::create([
            'employee_id'       =>      $employee_id,
            'time_in'           =>      Request::get('time_in'),
            'time_out'          =>      Request::get('time_out'),
        ]);

        foreach(Request::get('restday_id') as $key => $value){
            Employee_restday::updateOrCreate([
                'employee_id'       =>      $employee_id,
                'weekday_id'        =>      $value,  
            ]);
        }

        Alert::success('Success', 'Employee Created Successfully');
        return redirect()->back();
    }

    public function edit($id){
        $employee = Employee::find($id);
        $departments = Department::orderBy('name')->get()->pluck('name','id');
        $positions = Position::orderBy('name')->get()->pluck('name','id');
        $branches = Branch::orderBy('name')->get()->pluck('name','id');
        $categories = Category::orderBy('name')->get()->pluck('name','id');
        $status = Employee_status::orderBy('name')->get()->pluck('name','id');
        $banks = Bank::orderBy('name')->get()->pluck('name','id');
        $weekdays = Weekday::orderBy('id')->get()->pluck('name','id');
        return view('admin.employees.edit',compact(
            'employee','departments','positions','branches','categories','status',
            'banks','weekdays'
        ));
    }

    public function update($id){
        $employee = Employee::find($id);
        $validator = Validator::make(Request::all(), [
            'emp_id'            =>  "required|unique:employees,emp_id,$employee->id,id",
            'lastname'          =>  'required',
            'firstname'         =>  'required',
            'birthdate'         =>  'required',
            'birthplace'        =>  'required',
            'gender'            =>  'required',
            'address'           =>  'required',
            'mobile'            =>  'required',
            'email'             =>  "required|unique:employees,email,$employee->id,id",
            'date_hired'        =>  'required',
            'department_id'     =>  'required',
            'branch_id'         =>  'required',
            'category_id'       =>  'required',
            'status_id'         =>  'required',
            'position_id'       =>  'required',
            'time_in'           =>  'required',
            'time_out'          =>  'required',
            'bank_id'           =>  'required',
            'restday_id'        =>  "required|array|min:1",
        ],
        [
            'emp_id.required'           =>  'Emp ID Required',
            'lastname.required'         =>  'Last Name Required',
            'firstname.required'        =>  'First Name Required',
            'birthdate.required'        =>  'Birthdate Required',
            'gender.required'           =>  'Please Select Gender',
            'address.required'          =>  'Address Required',
            'mobile.required'           =>  'Contact # Required',
            'email.required'            =>  'Email Address Required',
            'date_hired.required'       =>  'Date Hired Required',
            'department_id.required'    =>  'Please Select Department',
            'branch_id.required'        =>  'Please Select Branch',
            'category_id.required'      =>  'Please Select Category',
            'status_id.required'        =>  'Please Select Employee Status',
            'position_id.required'      =>  'Please Select Position',
            'bank_id.required'          =>  'Please Select Bank',
            'time_in.required'          =>  'Time-in Required',
            'time_out.required'         =>  'Time-out Required',
            'restday_id.required'       =>  'Please Select Restday',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $file = Request::file('photo');

        if($file != NULL){
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(50).'.'.$extension;
            $file->move(public_path().'/photo',$fileName);
        }else{
            $fileName = $employee->photo;
        }

        $employee->update([
            'emp_id'        =>      Request::get('emp_id'),
            'lastname'      =>      Request::get('lastname'),
            'firstname'     =>      Request::get('firstname'),
            'middlename'    =>      Request::get('middlename'),
            'extname'       =>      Request::get('extname'),
            'address'       =>      Request::get('address'),
            'gender'        =>      Request::get('gender'),
            'email'         =>      Request::get('email'),
            'mobile'        =>      Request::get('mobile'),
            'birthdate'     =>      Request::get('birthdate'),
            'birthplace'    =>      Request::get('birthplace'),
            'civil_status'  =>      Request::get('civil_status'),
            'photo'         =>      $fileName,
        ]);

        $employee->emp_geninfo->update([
            'date_hired'        =>      Request::get('date_hired'),
            'date_separated'    =>      Request::get('date_separated'),
            'department_id'     =>      Request::get('department_id'),
            'position_id'       =>      Request::get('position_id'),
            'branch_id'         =>      Request::get('branch_id'),
            'category_id'       =>      Request::get('category_id'),
            'status_id'         =>      Request::get('status_id'),
        ]);

        $employee->emp_salinfo->update([
            'bank_id'           =>      Request::get('bank_id'),
            'account_number'    =>      Request::get('account_number'),
            'salary'            =>      Request::get('salary'),
        ]);

        $employee->emp_schedule->update([
            'time_in'           =>      Request::get('time_in'),
            'time_out'          =>      Request::get('time_out'),
        ]);

        foreach(Request::get('restday_id') as $key => $value){
            Employee_restday::updateOrCreate([
                'employee_id'       =>      $employee->id,
                'weekday_id'        =>      $value,  
            ]);
        }

        Alert::success('Success', 'Employee Updated Successfully');
        return redirect()->back();
    }

}
