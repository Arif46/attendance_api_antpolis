<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\Company;
use App\Designation;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       $companyList = Company::all();
        return view('admin.pages.company',\compact('companyList'));
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
         $company = new Company();
        $company->company_name = $request->company_name;
        $company->save();
        return response()->json( $company);
    }
     public function detail(Request $request){
        if($request->type=='show'){
            // $department =  Department::find($request->id);
             $company = Company::with('departments')->find($request->id);
            return response()->json([
                'company'=>$company,
            ]);
        }else{
            $company = Company::find($request->id);
             $companyList = Company::all();
            return response()->json([
                'company'=>$company,
                'companyList'=>$companyList
            ]);
        }
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
        // dd($request);
         $company =  company::find($request->id);
        $company->company_name = $request->company_name_modal;
        // $company->company_id = $request->select_company_modal;
        $company->save();
        $company = company::find($company->id);
        return response()->json([
            'company'=>$company
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
          $company = Company::find($request->id);
        $company->delete();
        return response()->json($company);
    }
}
