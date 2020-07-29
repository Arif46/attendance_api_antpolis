<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use JWTAuth;
use App\User;
use App\AttendanceLog;
use App\Attendance;
use Carbon\Carbon;
class AttendanceController extends Controller
{

      protected $user;
 
     public function __construct()
        {
            $this->user = JWTAuth::parseToken()->authenticate();
        }
    public function check_last_status(){
        $last_row=AttendanceLog::where('user_id',$this->user->id)
                    ->whereDate('attendance_date',Carbon::today()->toDateString())
                    ->orderBy('id', 'DESC')
                    ->first();
                   ;
        if (!is_null($last_row)) {
            if (!is_null($last_row->check_out) && !is_null($last_row->check_in)) {
                  return response()->json([
                            'success'=>true,
                            'status'=>false,
                            'message'=>'Checked out',
                        ]);
            }elseif (is_null($last_row->check_out) && is_null($last_row->check_in)) {
                 return response()->json([
                            'success'=>false,
                            'status'=>null,
                            'message'=>'Empty !',
                        ]);
            }elseif (!is_null($last_row->check_out) && is_null($last_row->check_in)) {
                 return response()->json([
                            'success'=>true,
                            'status'=>false,
                            'message'=>'Checked out',
                        ]);
            }elseif (is_null($last_row->check_out) && !is_null($last_row->check_in)) {
                 return response()->json([
                            'success'=>true,
                            'status'=>true,
                             'message'=>'Checked in',
                        ]);
            }
        }else{
            return response()->json([
                            'success'=>false,
                            'status'=>null,
                            'message'=>'Empty !',
                        ]);
        }
    }

    // find last status for check in and check out functions only 
    public function find_last_status(){
        $last_row=AttendanceLog::where('user_id',$this->user->id)
                    ->whereDate('attendance_date',Carbon::today()->toDateString())
                    ->orderBy('id', 'DESC')
                    ->first();
                   ;
        if ($last_row) {
            return $last_row;
        }else{
            return false;
        }
    }
     public function check_in(Request $request)
    {   
            if ($this->find_last_status()) {
                 if (!is_null($this->find_last_status()->check_out))
                   {
                 $attendance = new AttendanceLog();
                 $attendance->user_id=$this->user->id;
                 $attendance->attendance_date=Carbon::now();
                 $attendance->check_in= Carbon::Now()->toTimeString();
                 $attendance->save();
                 if ($attendance) {
                     return response()->json([
                            'success'=>true,
                            'data'=>$attendance
                        ]);

                 }
                   } else{
                   return response()->json([
                            'success'=>false,
                            'message'=>"You are already In!! First Checkout "
                        ]);
                   }

            }else{
                $attendance= new  AttendanceLog();
                $attendance->user_id=$this->user->id;
                $attendance->attendance_date=Carbon::now();
                $attendance->check_in= Carbon::Now()->toTimeString();
                $attendance->save();
                if ($attendance) {
                     return response()->json([
                            'success'=>true,
                            'data'=>$attendance
                        ]);
                 }
                }
        }
    public function check_out()
     {
        if ($this->find_last_status()) {
               if (is_null($this->find_last_status()->check_out))
                   {
                    // dd($last_row);
                 $attendance = new AttendanceLog();
                 $attendance=$attendance->find($this->find_last_status()->id);
                 $attendance->user_id=$this->user->id;
                 $attendance->attendance_date=Carbon::now();
                 $attendance->check_out=Carbon::Now()->toTimeString();
                 $attendance->save();
                 if ($attendance) {
                     return response()->json([
                            'success'=>true,
                            'data'=>$attendance
                        ]);
                 }
                   } else{
                   return response()->json([
                            'success'=>false,
                            'message'=>"You are already Checked out! First checked in Then Check Out"
                        ]);
                   }
        }else{
            // dd('last satus false no Data Yet');
            return response()->json([
                            'success'=>false,
                            'message'=>"You have to check in first"
                        ]);
        }
       

    }
      public function users_log_of_a_day(Request $request){
        // return $request->user_id;
        $attendances=  AttendanceLog::select(array(
            'user_id','attendance_date as Date','check_in as InTime','check_out as OutTime', 
            DB::raw("TIMEDIFF(check_out,check_in)Duration")))
                    ->where('user_id',$request->user_id)
                    ->whereDate('attendance_date',$request->attendance_date)
                    ->orderBy('id', 'DESC')
                    ->get();
                // dd(gettype($attendances));
        if (count($attendances)>0) {
            return response()->json([
                            'success'=>true,
                            'data'=>$attendances
                        ]);
        }else{
            return response()->json([
                            'success'=>false,
                            'message' =>$request->user_id.' s attendance not availble for '.$request->attendance_date.'',
                        ],500);
        }
       
    }
   
}
