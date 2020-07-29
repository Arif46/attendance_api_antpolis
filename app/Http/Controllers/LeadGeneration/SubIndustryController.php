<?php

namespace App\Http\Controllers\LeadGeneration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LeadGeneration\LeadIndustry;
use App\LeadGeneration\LeadSubIndustry;
class SubIndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $subIndustryList = LeadSubIndustry::all();
         // dd($subIndustryList);
         foreach ($subIndustryList as $item) {
             // dd($item->lead_industry);
         }
         $industryList = LeadIndustry::all();
        return view('admin.pages.leads.lead_subIndustry',\compact('subIndustryList','industryList'));
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
        $sub_industry = new LeadSubIndustry();
        $sub_industry->lead_sub_industry_name = $request->sub_industry_name;
        $sub_industry->lead_industry_id = $request->select_industry;
        $sub_industry->save();
        $sub_industry = LeadSubIndustry::with('lead_industry')->find($sub_industry->id);
            return response()->json([
                'sub_industry'=>$sub_industry,
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
         $sub_industry = LeadSubIndustry::with('lead_industry')->find($request->id);
            return response()->json([
                'sub_industry'=>$sub_industry,
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
         $sub_industry = LeadSubIndustry::with('lead_industry')->find($request->id);
            $industryList = LeadIndustry::all();
         return response()->json([
                            'sub_industry'=>$sub_industry,
                            'industryList'=>$industryList
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
        $sub_industry =  LeadSubIndustry::find($request->id);
        $sub_industry->lead_sub_industry_name = $request->sub_industry_name_edit;
        $sub_industry->lead_industry_id = $request->select_industry_edit;
        $sub_industry->save();
        $sub_industry = LeadSubIndustry::with('lead_industry')->find($sub_industry->id);
        return response()->json([
            'sub_industry'=>$sub_industry
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
          $sub_industry = LeadSubIndustry::find($request->id);
          $sub_industry->delete();
        return response()->json($sub_industry);
    }
}
