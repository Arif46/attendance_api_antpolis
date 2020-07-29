<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Company;
use App\Designation;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $departmentList=Department::with('company')->get();   
       // $departmentList = Department::with('company')->get();
       // $departmentList = Department::find(3);
       $departmentList = Department::all();
      
       $companyList = Company::all();
       // foreach ($departmentList as $item){
       // dd($item->company);
       // }
       return view('admin.pages.department',\compact('departmentList','companyList'));
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
     public function detail(Request $request){
        if($request->type=='show'){
             $department = Department::with('company','SubDepartments')->find($request->id);
            // $designation =  $department->designations;
            return response()->json([
                'department'=>$department
            ]);
        }else{
            $department = Department::with('company','SubDepartments')->find($request->id);
             $companyList = Company::all();
            return response()->json([
                'department'=>$department,
                'companyList'=>$companyList
            ]);
        }
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
        $department = new Department();
        $department->department_name = $request->dept_name;
        $department->company_id = $request->company_id;
        $department->save();
        $department = Department::with('company')->find($department->id);
        // $de= $department->toArray();  $upload = \Upload::with('mime')->first();
        // dd($department);
        //   return response()->json([
        //     'success' => true,
        //     'department' => $department
        // ], 200);
        // dd($department->company);
        return response()->json( $department);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $department =  Department::find($request->id);
        $department->department_name = $request->department_name_modal;
        $department->company_id = $request->select_company_modal;
        $department->save();
        $department = Department::with('company')->find($department->id);
        return response()->json([
            'department'=>$department
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
        $department = Department::find($request->id);
        $department->delete();
        return response()->json($department);
    }

}
