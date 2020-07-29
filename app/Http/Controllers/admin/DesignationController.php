<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Company;
use App\Designation;
use App\SubDepartment;
class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          $designationList = Designation::with('sub_department')->get();
          foreach ($designationList as $item) {
              // dd($item->sub_department->sub_department_name);
          }
          $subDepartmentList = SubDepartment::all();
          $companyList = Company::all();
          $departmentList = Department::all();
        return view('admin.pages.designation',\compact('designationList','departmentList','companyList','subDepartmentList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $designation = new Designation();
        $designation->designation_name = $request->designation_name;
        $designation->sub_department_id = $request->select_sub_department;
        $designation->save();
       // $designation = Designation::join("sub_departments","sub_departments.id","=","designations.sub_department_id")
       // ->join("departments","departments.id","=","sub_departments.department_id")
       // ->join("companies","companies.id","=","departments.company_id")->find($designation->id);


       $designation_data = Designation::with('sub_department','sub_department.department','sub_department.department.company')->find($designation->id);
        // dd($designation_data);
        return response()->json( ['designation'=>$designation_data]);  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request)
    {
        //
       //  $designation = Designation::join("sub_departments","sub_departments.id","=","designations.sub_department_id")
       // ->join("departments","departments.id","=","sub_departments.department_id")
       // ->join("companies","companies.id","=","departments.company_id")->find($request->id);
         $designation_data = Designation::with('sub_department','sub_department.department','sub_department.department.company')->find($request->id);

          $SubDepartment = SubDepartment::all();
            return response()->json([
                'designation'=>$designation_data,
                'subDepartmentList'=>$SubDepartment
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        //
        $designation =  Designation::find($request->id);
        $designation->designation_name = $request->designation_name_modal;
        $designation->sub_department_id = $request->select_sub_department_modal;
        $designation->save();

          $designation_data = Designation::with('sub_department','sub_department.department','sub_department.department.company')->find($designation->id);
        return response()->json([
            'designation'=>$designation_data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
         $designation = Designation::find($request->id);
        $designation->delete();
        return response()->json($designation);
    }
}
