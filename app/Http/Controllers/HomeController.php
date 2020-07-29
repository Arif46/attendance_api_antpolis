<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Company;
use App\Designation;
use App\SubDepartment;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (User::count() >0) {
            $totalUsers=User::count();
        }else{
            $totalUsers=0;
        }if (Department::count() >0) {
            $totalDepartments = Department::count();
            # code...
        }else{
            $totalDepartments=0;
        }if (SubDepartment::count() >0) {
            $totalSubDepartments  = SubDepartment::count();
            # code...
        }else{
            $totalSubDepartments =0;
        }if (Designation::count() >0) {
            $totalDesignations  = Designation::count();
            # code...
        }else{
            $totalDesignations =0;
        }

        return view('admin.index',compact('totalUsers','totalDepartments','totalSubDepartments','totalDesignations'));
    }
}
