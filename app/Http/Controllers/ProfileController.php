<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
// use Validator;
use App\Department;
use App\Company;
use App\Designation;
use App\SubDepartment;
use App\User;
use App\Remark;
use App\UserInformation;
use Carbon\Carbon;
use DateTime;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $remarks=Remark::where("user_id_receiver",Auth::user()->id)->get();
        $user = User::with('user_information')->find(Auth::user()->id);

        return view('admin.pages.profile',compact('user','remarks'));
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
  public function edit(Request $request){
        $user = User::with('user_information')->find(Auth::user()->id);
        if ($user) {
            return response()->json([
                'success'=>true,
                'user'=>$user
            ]);
        }else{
            return response()->json([
               'success'=>false,
                'message'=>'Failed To Find UserInformation'
            ]);
        }
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request){
        // $user= 
       

        $date=DateTime::createFromFormat('d/m/Y',$request->dob_edit);
        $new_dob_edit= $date->format('Y-m-d');
        $user = new User();
        $user = $user->find(Auth::user()->id);
        if($user->is_approved==1){
             return response()->json([
               'success'=>false,
                'message'=>'Permission Prohibited!Contact With HR!'
            ]);
        }
        $validator = Validator::make($request->all(), [
               'is_approved' => 'is_approved,0',
               'personal_email' => 'email|unique:users,personal_email,' . $user->id,
           ]);
            
           if ($validator->fails()) {
              return $validator->messages()->first();
           }
        $prev_photo_name= $user['photo']; 
        $prev_identification_photo_name= $user['identification_photo'];

         if (!empty($request->photo_edit)) {
        // dd($request->photo_edit);
            $file = $request->file('photo_edit');
            if(!$file->isValid()) {
            return response()->json(['invalid_file_upload'], 400);
          }
          $path = public_path() . '/images/users';
          $name = sha1(date('YmdHis') . Str::random(30));
          $save_name = $name . '.' . $file->getClientOriginalExtension();
          $file->move($path, $save_name);
          $user->photo =$save_name;
          $user->update();
          // ;
            if (file_exists('images/users/'.$prev_photo_name)) {
            // unlink('images/users/'.$prev_photo_name);
            }
    }


 if (!empty($request->identification_photo_edit)) {
       // dd($request->identification_photo_edit);
        $file = $request->file('identification_photo_edit');
        if(!$file->isValid()) {
        return response()->json(['invalid_file_upload'], 400);
      }
      $path = public_path() . '/images/users/identifications';
      $name = sha1(date('YmdHis') . Str::random(30));
      $save_name = $name . '.' . $file->getClientOriginalExtension();
      $file->move($path, $save_name);
      $user->identification_photo =$save_name;
      $user->update();
      // ;
        if (file_exists('images/users/identifications/'.$prev_identification_photo_name)) {
        // unlink('images/users/identifications/'.$prev_identification_photo_name);
        }
    }
$user->update($request->except(['photo','identification_photo','financial_statements']));

         $user->forceFill([
            'first_name' => $request->first_name_edit,
            'last_name' => $request->last_name_edit,
            'middle_name' => $request->middle_name_edit,
            'dob' => $new_dob_edit,
            'gender' => $request->gender_edit,
            'blood_group' => $request->blood_group_edit,
            'medical_condition' => $request->medical_condition_edit,
            'identification_type' => $request->identification_type_edit,
            'identification_number' => $request->identification_number_edit,
            'permanent_address' => $request->permanent_address_edit,
            'present_address' => $request->present_address_edit,
            'mobile_number' => $request->mobile_number_edit,
            'personal_email' => $request->personal_email_edit,
            'fb_username' => $request->fb_username_edit,
            'emergency_person_name' => $request->emergency_person_name_edit,
            'emergency_person_relation' => $request->emergency_relation_edit,
            'emergency_number' => $request->emergency_number_edit,
            'discord_id' => $request->discord_id_edit,

])->update();
        // dd($user);
             // now for user information work experience 
       $user_information= new UserInformation();
       $user_information = $user_information->updateOrCreate(
                    ['user_id' => Auth::user()->id]
                );
                // start financial information
                $data_financial= [
                'personal_bank_name' => $request->personal_bank_name_edit,
                'personal_bank_account_name' => $request->personal_bank_account_name_edit,
                'personal_bank_account_number' => $request->personal_bank_account_number_edit,
                'personal_bank_branch_name' => $request->personal_bank_branch_name_edit,
                'personal_bank_branch_routing_number' => $request->personal_bank_branch_routing_number_edit,
                'bkash_account_number' => $request->bkash_account_number_edit,
                'bkash_account_type' => $request->bkash_account_type_edit,
            ];
    $user_information->financial_information=$data_financial;
       // end financial information
      // start  work_experience
       if (!is_null($request->we_jobTitle)) {
       $experience_array=array();
      $we_details=array();
     $count = count($request->we_jobTitle);
      for ($i=0; $i <$count ; $i++) {
        if (!is_null($request->we_jobTitle[$i])) {
        $we_details['title']=$request->we_jobTitle[$i];
        $we_details['company']=$request->we_companyName[$i];
        $we_details['joinDate']=$request->we_joinedDate[$i];
        $we_details['LeftDate']=$request->we_leftDate[$i];
         array_push($experience_array,$we_details);        }
      }
      $user_information->work_experience=$experience_array;
    }
      // end of work experince
      // start of educational Qualification
    if (!is_null($request->eq_degree)) {
       $educational_array=array();
         $eq_details=array();
           $count = count($request->eq_degree);
            for ($i=0; $i <$count ; $i++) 
            {
              if (!is_null($request->eq_degree[$i])) 
              {
              $eq_details['degree']=$request->eq_degree[$i];
              $eq_details['programOrGroup']=$request->eq_programOrGroup[$i];
              $eq_details['institution']=$request->eq_institution[$i];
              $eq_details['gpa']=$request->eq_gpa[$i];
              $eq_details['major']=$request->eq_major[$i];
              $eq_details['minor']=$request->eq_minor[$i];
              $eq_details['passingDate']=$request->eq_passingDate[$i];
               array_push($educational_array,$eq_details);        
             }
            }
            // return (json_encode($educational_array, JSON_PRETTY_PRINT));
          $user_information->educational_qualification=$educational_array;
        }
      // end of educational Qualification   
         // start of Skills
    if (!is_null($request->sk_name)) {
       $skill_array=array();
         $sk_details=array();
           $count = count($request->sk_name);
            for ($i=0; $i <$count ; $i++) 
            {
              if (!is_null($request->sk_name[$i])) 
              {
              $sk_details['name']=$request->sk_name[$i];
              $sk_details['category']=$request->sk_category[$i];
              $sk_details['workspace']=$request->sk_workspace[$i];
              $sk_details['profeciency']=$request->sk_profeciency[$i];
              array_push($skill_array,$sk_details);        
             }
            }
            // return (json_encode($skill_array, JSON_PRETTY_PRINT));
          $user_information->skill=$skill_array;
        }
      // end of Skills
      $user_information->save();
      // end of user information
            return response()->json([
                'success'=>true,
                'user'=>$user
            ]);
      
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approval_profile_data()
    {
        $users =User::where("is_approved",0)->get();
        return view('admin.pages.profile_approval',compact('users'));
    }
    public function approve_profile(Request $request)
    {
         $user=User::find($request->id);
         if (!$user) {
            return response()->json([
                'success'=>false,
                'message'=>'Failed to Find User||You Do not Have Permission'
            ]);
         }
         $user->is_approved=1;
         if ($user->save()) {
               return response()->json([
                'success'=>true,
                'message'=>'Approved SuccessFully'
            ]);
         }

    }
    public function profile_remarks_store(Request $request)
    {
        // dd($request);
         $remark=new Remark();
         $remark->user_id_receiver=$request->remark_receiver;
         $remark->subject=$request->remark_subject;
         $remark->description=$request->remark_description;
         $remark->user_id_sender=Auth::user()->id;
         if ($remark->save()) {
               return response()->json([
                'success'=>true,
                'remark'=>$remark
            ]);
         }else{
              return response()->json([
                'success'=>false,
                'message'=>'Failed To Save Remark'
            ]);
         }
    }  
    public function profile_remarks_show(Request $request)
    {
        // dd($request);
         $remark=Remark::find($request->id);
         if ($remark) {
               return response()->json([
                'success'=>true,
                'remark'=>$remark
            ]);
         }else{
              return response()->json([
                'success'=>false,
                'message'=>'Failed To Find Remark'
            ]);
         }
    }
}
