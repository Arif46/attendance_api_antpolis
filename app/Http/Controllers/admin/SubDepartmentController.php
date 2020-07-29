<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Company;
use App\Designation;
use App\SubDepartment;


class SubDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $sub_departmentList = SubDepartment::with('department','designations')->get();
       $departmentList = Department::all();
       $companyList = Company::all();
      return view('admin.pages.sub_department',\compact('sub_departmentList','departmentList','companyList'));
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
        // dd($request);
        $sDepart = new SubDepartment();
        $sDepart->sub_department_name = $request->sub_department_name;
        $sDepart->department_id = $request->select_parent_department;
        $sDepart->save();
        // $SubDepartment = SubDepartment::with('department')->find($SubDepartment->id);
       // $SubDepartment = SubDepartment::join("departments","departments.id","=","sub_departments.department_id")->join("companies","companies.id","=","departments.company_id")->find($sDepart->id);
      
       $SubDepartment = SubDepartment::with('department','designations','department.company')->find($sDepart->id);
        // dd($SubDepartment);
        return response()->json( $SubDepartment);  
          }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail(Request $request){
        // dd($request);
        if($request->type=='show'){
             $SubDepartment = SubDepartment::with('designations')->find($request->id);
            // $designation =  $department->designations;
            return response()->json([
                'SubDepartment'=>$SubDepartment
            ]);
        }else{
            $SubDepartment = SubDepartment::with('designations')->find($request->id);
             $departmentList = Department::all();
             $companyList = Company::all();
            return response()->json([
                'SubDepartment'=>$SubDepartment,
                'departmentList'=>$departmentList,
                'companyList'=>$companyList
            ]);
        }
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
        //
        // dd($request);
        $sDepart =  SubDepartment::find($request->id);
        $sDepart->sub_department_name = $request->sub_department_name_modal;
        $sDepart->department_id = $request->select_department_modal;
        $sDepart->save();
        // $SubDepartment = SubDepartment::join("departments","departments.id","=","sub_departments.department_id")->join("companies","companies.id","=","departments.company_id")->find($SubDepartment->id);
        $SubDepartment = SubDepartment::with('department','designations','department.company')->find($request->id);
        return response()->json([
            'SubDepartment'=>$SubDepartment
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
          $SubDepartment = SubDepartment::find($request->id);
        $SubDepartment->delete();
        return response()->json($SubDepartment);
    }
}
