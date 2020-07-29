<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
// use Validator;
use App\Department;
use App\Company;
use App\Designation;
use App\SubDepartment;
use App\User;
use App\UserInformation;
use Carbon\Carbon;
use DateTime;
class UserController extends Controller
{
    //
    public function index(){
       $users = User::all();

      // return view('admin.pages.add-employee');
      return view('admin.pages.add_employee',\compact('users'));
    }
    
    
     public function store( Request $request){
   // dd($request);
     
  
// $new_dob=Carbon::createFromFormat('Y-m-d', $request->dob);
// dd($new_dob);
$date=DateTime::createFromFormat('d/m/Y',$request->dob);
$new_dob= $date->format('Y-m-d');
// $new_dob=Carbon::parse($request->dob)->format('Y-m-d');
// dd($new_dob);

      $user = new User();
        $validator = Validator::make($request->all(), [
           'email' => 'unique:users,email,'
       ]);
       if ($validator->fails()) {
          return $validator->messages()->first();
       }
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->gender = $request->gender;
        $user->present_address = $request->present_address;
        $user->permanent_address = $request->permanent_address;
        $user->fb_username = $request->fb_username;

        $user->emergency_person_name = $request->emergency_person_name;
        $user->emergency_person_relation = $request->emergency_relation;
        $user->emergency_number = $request->emergency_number;

        $user->discord_id = $request->discord_id;

        $user->blood_group = $request->blood_group;
        $user->medical_condition = $request->medical_condition;
        $user->dob = $new_dob;
        $user->photo = $request->photo;

        $user->identification_type = $request->identification_type;
        $user->identification_number = $request->identification_number;
        // $user->identification_photo = $request->identification_photo;
        // json
     

          if($request->hasFile('photo')) {
      $file = $request->file('photo');
      if(!$file->isValid()) {
        return response()->json(['invalid_file_upload'], 400);
      }
      $path = public_path() . '/images/users';
      $name = sha1(date('YmdHis') . Str::random(30));
        $save_name = $name . '.' . $file->getClientOriginalExtension();
      $file->move($path, $save_name );
        $user->photo =$save_name;
    }   

    if($request->hasFile('identification_photo')) {
      $file = $request->file('identification_photo');
      if(!$file->isValid()) {
        return response()->json(['invalid_file_upload'], 400);
      }
      $path = public_path() . '/images/users/identifications';
      $name = sha1(date('YmdHis') . Str::random(30));
        $save_name = $name . '.' . $file->getClientOriginalExtension();
      $file->move($path, $save_name );
        $user->identification_photo =$save_name;
    }

  
     $data_financial= [
        'personal_bank_name' => $request->personal_bank_name,
        'personal_bank_account_name' => $request->personal_bank_account_name,
        'personal_bank_account_number' => $request->personal_bank_account_number,
        'personal_bank_branch_name' => $request->personal_bank_branch_name,
        'personal_bank_branch_routing_number' => $request->personal_bank_branch_routing_number,
        'bkash_account_number' => $request->bkash_account_number,
        'bkash_account_type' => $request->bkash_account_type,
    ];
    // dd($data_financial);
        // json
        $user->save(); 
        // start of user information
         $user_information= new UserInformation();
         // save financial_information
         $user_information->user_id= $user->id;
         $user_information->financial_information = $data_financial;  
         // save financial_information
      // start of work experinece
         if (!is_null($request->we_jobTitle)) {
         $experience_array=array();
         $we_details=array();
           $count = count($request->we_jobTitle);
            for ($i=0; $i <$count ; $i++) 
            {
              if (!is_null($request->we_jobTitle[$i])) 
              {
              $we_details['title']=$request->we_jobTitle[$i];
              $we_details['company']=$request->we_companyName[$i];
              $we_details['joinDate']=$request->we_joinedDate[$i];
              $we_details['LeftDate']=$request->we_leftDate[$i];
               array_push($experience_array,$we_details);        
             }
            }
            // return (json_encode($experience_array, JSON_PRETTY_PRINT));
          $user_information->work_experience=$experience_array;
        }
          // $user_information->user_id= $user->id;
          // $user_information->save();
// end of work experience 
        // start of Educational Qualification
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
          $user_information->educational_qualification=$educational_array;
               }
          // $user_information->user_id= $user->id;
// end of Educational Qualification  
 // start of Skill of Employee
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
          $user_information->skill=$skill_array;
        }
// end of Skill of Employee 
          
          $user_information->save();
        // end of user information
         return response()->json([
                'user'=>$user
            ]);
    }



    public function show(Request $request){
            $user = User::with('user_information')->find($request->id);
            return response()->json([
                'user'=>$user
            ]);
      
          
    }
    public function edit(Request $request){
      // workexperience find
       // $user_information= new UserInformation();
       // $user = $user->find($request->id);
      // workexperience find
              // $user = new User();
             // $user = $user->find($request->id);
             $user = User::with('user_information')->find($request->id);
             // dd($user);
            return response()->json([
                'user'=>$user
            ]);
      
          
    }  
    public function update(Request $request){
      // user information
     
      // User::where('username','John') -> first();
// $new_dob_edit=Carbon::parse($request->dob)->format('Y-m-d');
$date=DateTime::createFromFormat('d/m/Y',$request->dob_edit);
$new_dob_edit= $date->format('Y-m-d');
 $user = new User();
$user = $user->find($request->edit_user_id);

 $validator = Validator::make($request->all(), [
           'email' => 'unique:users,email,' . $user->id
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
    // 'financial_statements->personal_bank_name' => $request->personal_bank_name_edit,
    // 'financial_statements->personal_bank_account_name' => $request->personal_bank_account_name_edit,
    // 'financial_statements->personal_bank_account_number' => $request->personal_bank_account_number_edit,
    // 'financial_statements->personal_bank_branch_name' => $request->personal_bank_branch_name_edit,
    // 'financial_statements->personal_bank_branch_routing' => $request->personal_bank_branch_routing_number_edit,
    // 'financial_statements->bkash_account_number' => $request->bkash_account_number_edit,
    // 'financial_statements->bkash_account_type' => $request->bkash_account_type_edit,

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
    'email' => $request->email_edit,
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
                    ['user_id' => $request->edit_user_id]
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
                'user'=>$user
            ]);
      
          
    }
    // end of update
    public function destroy(Request $request){
        $user_information= new UserInformation();
         $user = User::find($request->id);
        $user->delete();
        // delete user information
        $deleteUserInformation = $user_information->where('user_id',$request->id)->delete();
        // delete user information
        return response()->json([
            'user'=>$user,
        ]);
    }

}
