<?php

namespace App\Http\Controllers\LeadGeneration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\LeadGeneration\LeadCompany;
use App\LeadGeneration\LeadBrand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $brandList = LeadBrand::all();
         // dd($brandList);
         // foreach ($brandList as $item) {
         //     dd($item->brand_services);
         // }
         $companyList = LeadCompany::all();
        return view('admin.pages.leads.lead_brand',\compact('brandList','companyList'));
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
        $brand = new LeadBrand();
        $brand->lead_brand_name = $request->brand_name;
        $brand->lead_company_id = $request->select_company;
        $brand->lead_brand_website = $request->brand_website;
        $brand->lead_brand_facebook = $request->brand_facebook;
        $brand->lead_brand_instagram = $request->brand_instagram;
        $brand->lead_brand_linkedin = $request->brand_linkedin;
        $brand->lead_brand_youtube = $request->brand_youtube;
        $brand->lead_brand_comment = $request->brand_comment;
        // $brand->lead_brand_logo = $request->lead_brand_logo;
          if($request->hasFile('brand_logo')) {
      $file = $request->file('brand_logo');
      if(!$file->isValid()) {
        return response()->json(['invalid_file_upload'], 400);
      }
      $path = public_path() . '/images/leads/brands';
      $name = sha1(date('YmdHis') . Str::random(30));
      $save_name = $name . '.' . $file->getClientOriginalExtension();
      $file->move($path, $save_name );
      $brand->lead_brand_logo =$save_name;
  }


        $brand->save();
        $brand = LeadBrand::with('lead_company')->find($brand->id);
            return response()->json([
                'brand'=>$brand,
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
         $brand = LeadBrand::with('lead_company','brand_services.lead_product_or_service')->find($request->id);
            return response()->json([
                'brand'=>$brand,
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
         $brand = LeadBrand::with('lead_company')->find($request->id);
            $companyList = LeadCompany::all();
         return response()->json([
                            'brand'=>$brand,
                            'companyList'=>$companyList
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
        $brand =  LeadBrand::find($request->id);
        $prev_photo_name= $brand['lead_brand_logo']; 
         if (!empty($request->brand_logo_edit)) {
    // dd($request->brand_logo_edit);
        $file = $request->file('brand_logo_edit');
        if(!$file->isValid()) {
        return response()->json(['invalid_file_upload'], 400);
      }
      $path = public_path() . '/images/leads/brands';
      $name = sha1(date('YmdHis') . Str::random(30));
      $save_name = $name . '.' . $file->getClientOriginalExtension();
      // dd($save_name);
      $file->move($path, $save_name);
      $brand->lead_brand_logo =$save_name;
      // $user->update();
      // ;
        if (file_exists('images/leads/brands/'.$prev_photo_name)) {
        unlink('images/leads/brands/'.$prev_photo_name);
        }
    }

         $brand->lead_brand_website = $request->brand_website_edit;
        $brand->lead_brand_facebook = $request->brand_facebook_edit;
        $brand->lead_brand_instagram = $request->brand_instagram_edit;
        $brand->lead_brand_linkedin = $request->brand_linkedin_edit;
        $brand->lead_brand_youtube = $request->brand_youtube_edit;
        $brand->lead_brand_comment = $request->brand_comment_edit;
        $brand->lead_brand_name = $request->brand_name_edit;
        $brand->lead_company_id = $request->select_company_edit;
        // $user->update($request->except(['photo','nid_photo','financial_statements']));

        $brand->save();
        $brand = LeadBrand::with('lead_company')->find($brand->id);
        return response()->json([
            'brand'=>$brand
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
          $brand = LeadBrand::find($request->id);
          $brand->delete();
        return response()->json($brand);
    }
}
