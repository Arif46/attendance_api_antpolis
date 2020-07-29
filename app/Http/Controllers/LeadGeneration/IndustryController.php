<?php

namespace App\Http\Controllers\LeadGeneration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LeadGeneration\LeadIndustry;
use App\LeadGeneration\LeadSubIndustry;
class IndustryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $industryList = LeadIndustry::all();
        return view('admin.pages.leads.lead_industry',\compact('industryList'));
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
        $industry = new LeadIndustry();
        $industry->lead_industry_name = $request->industry_name;
        $industry->save();
            return response()->json([
                'industry'=>$industry,
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
         $industry = LeadIndustry::with('sub_industries')->find($request->id);
            return response()->json([
                'industry'=>$industry,
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
         $industry = LeadIndustry::find($request->id);
         return response()->json([
                            'industry'=>$industry,
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
        $industry =  LeadIndustry::find($request->id);
        $industry->lead_industry_name = $request->industry_name_edit;
        $industry->save();
        return response()->json([
            'industry'=>$industry
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
          $industry = LeadIndustry::find($request->id);
          $industry->delete();
        return response()->json($industry);
    }
}
