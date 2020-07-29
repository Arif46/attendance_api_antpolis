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
use DateTime;
use Input;
class NewAttendanceController extends Controller
{
  public static function CalculateTime($times) {
          $all_seconds = 0;
          foreach ($times as $time) {
            list($hour, $minute, $second) = explode(':', $time);
            $all_seconds += $hour * 3600;
            $all_seconds += $minute * 60; $all_seconds += $second;

        }


        $total_minutes = floor($all_seconds/60); $seconds = $all_seconds % 60;  $hours = floor($total_minutes / 60); $minutes = $total_minutes % 60;


        return sprintf('%02d:%02d:%02d', $hours, $minutes,$seconds);
  }

  public function GetAttendancedaily($user_id, Request $request)
  {
    try{
       $date=$request->date;
      $attendance_data=AttendanceLog::where('user_id',$user_id)->wheredate('attendance_date',$date)->select('attendance_date','check_in','check_out','status')->get();
    
      foreach($attendance_data as $attendance) {
        $check_in = new DateTime($attendance->check_in);
        $check_out = new DateTime($attendance->check_out);
        $timeDiff = $check_in->diff($check_out);
        $AttandanceArr = [
          'inTime' => $attendance->check_in,
          'outTime' => $attendance->check_out,
          'duration' => $timeDiff->h . 'h:' . $timeDiff->i . 'm',
        ];
  
        $timeArr[] = $timeDiff->h . ':' . $timeDiff->i . ':' . $timeDiff->s;
        $attenDanceData[] = $AttandanceArr;
      }
  
    $checkIn = $attendance_data[0]->check_in;
    $checkOut = $attendance_data[0]->check_out;
    $status =$attendance_data[0]->status;
  
    // $d1 = new  DateTime($checkIn);
    // $d2 = new DateTime($checkOut); 
    // $Diff = $d1->diff($d2)->h . 'h: ' . $d1->diff($d2)->i. 'm: ' . $d1->diff($d2)->s. 's:';
    $TotalDurationSum = self::CalculateTime($timeArr);
  
  
         return response()->json([
  
                              'success'=>true,
                              'total_duration'=> $TotalDurationSum,
                              'initialInTime'=>$checkIn,
                              'lastOutTime'=>$checkOut,
                              'status'=>$status,
                              'attendance_data'=>$attenDanceData,
                          ],200);
    }catch(\Exception $e){
      return response()->json(['success'=>false,'total_duration'=>null,'attendance_date'=>null ],400);
    }
  

  }

  public function GetAttendanceMonthly($user_id,Request $request)
  {

   try{
     $start_date=$request->start_date;
     $end_date=$request->end_date;
    $attendance_data=AttendanceLog::where('user_id',$user_id)->whereBetween('attendance_date',[$start_date,$end_date])->select('attendance_date','check_in','check_out','status')->get();
   
    foreach($attendance_data as $attendance){
          $check_in= new DateTime($attendance->check_in);
          $check_out= new DateTime($attendance->check_out);
          $timeDiff = $check_in->diff($check_out);
          $AttandanceArr = [
           'attendance_date'=>$attendance->attendance_date,
           'inTime' => $attendance->check_in,
           'outTime' => $attendance->check_out,
           'status' =>$attendance->status,
           'duration' => $timeDiff->h . 'h:' . $timeDiff->i . 'm:' .$timeDiff->s. 's' ,
         ];
   
         $timeArr[] = $timeDiff->h . ':' . $timeDiff->i . ':' . $timeDiff->s;
         $attenDanceData[] = $AttandanceArr;
    }
     return response()->json([

       'success'=>true,
       'attendance_data'=>$attenDanceData,
   ],200);
    
   }catch (\Exception $e) {
    return response()->json(['sucess'=>false , 'attendance_data'=>null],400);
}
    
  
  }


  public function Gethomepage($user_id)
  {
     $total_checkin=AttendanceLog::where('user_id',$user_id)
     ->whereDate('attendance_date',today())->count('check_in');

     $attendance_report = AttendanceLog::where('user_id',$user_id)
                    ->whereDate('attendance_date',today())
                    ->where('check_out', NULL)->select('check_in')->get();

             

    if (count($attendance_report) > 0) {
      $check_in= new DateTime($attendance_report[0]->check_in);
      $current_time= new DateTime(strtotime('H:i:s'));
      $timeDiff = $check_in->diff($current_time);
                      
      $session_duration =  $timeDiff->h . 'h:' . $timeDiff->i . 'm:' .$timeDiff->s. 's';
      $starting_time =$attendance_report[0]->check_in;
      return response()->json(['sucess'=>'true','total_checkin_per_day'=>$total_checkin,'last_session_duration'=>$session_duration,'starting from'=>$starting_time],200);
    } else {
      return response()->json(['sucess'=>'false','total_checkin_per_day'=>Null,'last_session_duration'=>Null],400);
    }
  }

  public function GetCheckButton($user_id,$check_status)
  {
    $checkButton=Attendance::where('user_id',$user_id)->where('check_out',null)->get();
    $check_in=$checkButton[0]->check_in;
    return response()->json(['sucess'=>true,'check_status'=>$check_in],200);
  }
}
