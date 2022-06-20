<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::resource('/banks','BankController');
Route::get('/banks/delete/{id}',"BankController@delete")->name('banks.delete');

Route::resource('/branches','BranchController');
Route::get('/branches/delete/{id}',"BranchController@delete")->name('branches.delete');

Route::resource('/categories','CategoryController');
Route::get('/categories/delete/{id}',"CategoryController@delete")->name('categories.delete');

Route::resource('/employee-status','EmployeeStatusController');
Route::get('/employee-status/delete/{id}',"EmployeeStatusController@delete")->name('employee-status.delete');

Route::resource('/departments','DepartmentController');
Route::get('/departments/delete/{id}',"DepartmentController@delete")->name('departments.delete');

Route::resource('/positions','PositionController');
Route::get('/positions/delete/{id}',"PositionController@delete")->name('positions.delete');

Route::resource('/requirements','RequirementController');
Route::get('/requirements/delete/{id}',"RequirementController@delete")->name('requirements.delete');

Route::resource('/sanctions','SanctionController');
Route::get('/sanctions/delete/{id}',"SanctionController@delete")->name('sanctions.delete');

Route::resource('/violations','ViolationController');
Route::get('/violations/delete/{id}',"ViolationController@delete")->name('violations.delete');

Route::resource('/employees','EmployeeController');

// Route::get('/leaves', function () {
//     return view('admin.utilities.leaves.index');
// });

// Route::get('/requirements', function () {
//     return view('admin.utilities.requirements.index');
// });

// Route::get('/sanctions', function () {
//     return view('admin.utilities.sanctions.index');
// });

// Route::get('/violations', function () {
//     return view('admin.utilities.violations.index');
// });
