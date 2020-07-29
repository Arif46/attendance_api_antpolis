<?php

namespace App\Http\Controllers\LeadGeneration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\LeadGeneration\LeadCompany;
// use App\LeadGeneration\LeadSubcompany;
class CompanyLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $companyList = LeadCompany::all();
        return view('admin.pages.leads.lead_company',\compact('companyList'));
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
        // dd($request);
         // dd($request);
        $company = new LeadCompany();
        $company->lead_company_name = $request->company_name;
          if($request->hasFile('company_logo')) {
      $file = $request->file('company_logo');
      if(!$file->isValid()) {
        return response()->json(['invalid_file_upload'], 400);
      }
      $path = public_path() . '/images/leads/companies';
      $name = sha1(date('YmdHis') . Str::random(30));
      $save_name = $name . '.' . $file->getClientOriginalExtension();
      $file->move($path, $save_name );
      $company->lead_company_logo =$save_name;
  }

        $company->save();
            return response()->json([
                'company'=>$company,
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        // dd($request);
         $company = LeadCompany::with('brands')->find($request->id);
            return response()->json([
                'company'=>$company,
         ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
         $company = LeadCompany::find($request->id);
         return response()->json([
                            'company'=>$company,
                        ]);
        // dd($request);
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
        $company =  LeadCompany::find($request->id);

        $prev_photo_name= $company['lead_company_logo']; 
         if (!empty($request->company_logo_edit)) {
    // dd($request->company_logo_edit);
        $file = $request->file('company_logo_edit');
        if(!$file->isValid()) {
        return response()->json(['invalid_file_upload'], 400);
      }
      $path = public_path() . '/images/leads/companies';
      $name = sha1(date('YmdHis') . Str::random(30));
      $save_name = $name . '.' . $file->getClientOriginalExtension();
      // dd($save_name);
      $file->move($path, $save_name);
      $company->lead_company_logo =$save_name;
      // $user->update();
      // ;
        if (file_exists('images/leads/companies/'.$prev_photo_name)) {
        unlink('images/leads/companies/'.$prev_photo_name);
        }
    }
        $company->lead_company_name = $request->company_name_edit;
        $company->save();
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
        // dd($request);
          $company = LeadCompany::find($request->id);
          $company->delete();
        return response()->json($company);
    }
}
