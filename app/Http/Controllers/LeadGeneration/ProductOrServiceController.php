<?php

namespace App\Http\Controllers\LeadGeneration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LeadGeneration\LeadIndustry;
use App\LeadGeneration\LeadSubIndustry;
use App\LeadGeneration\LeadProductOrService;
class ProductOrServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $productOrServiceList = LeadProductOrService::all();
         // dd($productOrServiceList);
         // foreach ($productOrServiceList as $item) {
         //     // dd($item->lead_sub_industry->lead_industry);
         // }
         $subIndustryList = LeadSubIndustry::all();
        return view('admin.pages.leads.lead_productOrService',\compact('productOrServiceList','subIndustryList'));
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
        $product_or_service = new LeadProductOrService();
        $product_or_service->lead_product_or_service_name = $request->product_or_service_name;
        $product_or_service->is_lead_product_or_service = $request->is_product_or_service;
        $product_or_service->lead_sub_industry_id = $request->select_sub_industry;
        $product_or_service->save();
        $product_or_service = LeadProductOrService::with('lead_sub_industry','lead_sub_industry.lead_industry')->find($product_or_service->id);
        // dd($product_or_service->lead_sub_industry->lead_industry);
            return response()->json([
                'product_or_service'=>$product_or_service,
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
         $sub_industry = LeadProductOrService::with('lead_sub_industry','lead_sub_industry.lead_industry')->find($request->id);
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
         $product_or_service = LeadProductOrService::with('lead_sub_industry','lead_sub_industry.lead_industry')->find($request->id);
            $subIndustryList = LeadSubIndustry::all();
         return response()->json([
                            'product_or_service'=>$product_or_service,
                            'subIndustryList'=>$subIndustryList
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
        $product_or_service =  LeadProductOrService::find($request->id);
        $product_or_service->lead_product_or_service_name = $request->product_or_service_name_edit;
        $product_or_service->lead_sub_industry_id = $request->select_sub_industry_edit;
        $product_or_service->is_lead_product_or_service = $request->is_product_or_service_edit;
        $product_or_service->save();
        $product_or_service = LeadProductOrService::with('lead_sub_industry','lead_sub_industry.lead_industry')->find($product_or_service->id);
        return response()->json([
            'product_or_service'=>$product_or_service
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
          $product_or_service = LeadProductOrService::find($request->id);
          $product_or_service->delete();
        return response()->json($product_or_service);
    }
}
