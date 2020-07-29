<?php

namespace App\Http\Controllers\LeadGeneration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LeadGeneration\LeadIndustry;
use App\LeadGeneration\LeadSubIndustry;
use App\LeadGeneration\LeadProductOrService;
use App\LeadGeneration\LeadBrandService;
use App\LeadGeneration\LeadBrand;
class BrandServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $brandServiceList = LeadBrandService::all();
         // dd($productOrServiceList);
         // foreach ($productOrServiceList as $item) {
         //     dd($item->lead_product_or_service);
         // }
         $LeadBrandList = LeadBrand::all();
         $productOrServiceList = LeadProductOrService::all();
        return view('admin.pages.leads.lead_brandService',\compact('brandServiceList','LeadBrandList','productOrServiceList'));
    }  




    public function product_or_service_list(Request $request)
    {
        //
         $productOrServiceList = LeadProductOrService::where('is_lead_product_or_service', $request->id)
               ->get();
        return response()->json([
                'productOrServiceList'=>$productOrServiceList,
         ]);
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
        $brand_service = new LeadBrandService();
        $brand_service->lead_brand_id = $request->select_brand;
        $brand_service->lead_product_or_service_id = $request->select_product_or_service;
        $brand_service->save();
        $brand_service = LeadBrandService::with('lead_brand','lead_product_or_service')->find($brand_service->id);
        // dd($product_or_service->lead_sub_industry->lead_industry);
            return response()->json([
                'brand_service'=>$brand_service,
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
         $sub_industry = LeadBrandService::with('lead_brand','lead_product_or_service')->find($request->id);
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
         $brand_service = LeadBrandService::with('lead_brand','lead_product_or_service')->find($request->id);
         $productOrServiceList = LeadProductOrService::all();
         return response()->json([
                            'brand_service'=>$brand_service,
                            'productOrServiceList'=>$productOrServiceList
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
        $brand_service =  LeadBrandService::find($request->id);
        $brand_service->lead_product_or_service_id = $request->select_product_or_service_edit;
        $brand_service->lead_brand_id = $request->select_brand_edit;
        $brand_service->save();
        $brand_service = LeadBrandService::with('lead_brand','lead_product_or_service')->find($brand_service->id);
        return response()->json([
            'brand_service'=>$brand_service
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
          $brand_service = LeadBrandService::find($request->id);
          $brand_service->delete();
        return response()->json($brand_service);
    }
}
