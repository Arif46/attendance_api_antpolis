<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\SubDepartment;
use App\Company;
use App\User;
use App\AttendanceLog;
use App\Attendance;
use Auth;
use Carbon\Carbon;
use DB;
class AttendanceController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

public function AttendanceDataHuman($attendance_logs){
            foreach ($attendance_logs as $attendance) {
                    if ($attendance->InTime >'10:10:10') {
                        $status_m="Late";
                    }else{
                        $status_m="In Time";
                    }       
                    if (preg_match('/^\s*$/', $attendance->InTime)) { 
                        $InTime_Human="";
                    }else{
                         $InTime_Human=Carbon::parse($attendance->InTime)->format('g:i A');
                    }
                    if (preg_match('/^\s*$/', $attendance->OutTime)) { 
                        $OutTime_Human="";
                    }else{
                        $OutTime_Human=Carbon::parse($attendance->OutTime)->format('g:i A');
                    }
                    if (preg_match('/^\s*$/', $attendance->Duration)) { 
                        $Duration_Human="";
                    }else{
                       $Duration_Human=$attendance->Duration;
                    }
                    if (preg_match('/^\s*$/', $attendance->Date)) { 
                        $Date_Human="";
                    }else{
                       $Date_Human=Carbon::parse($attendance->Date)->format('d/m/yy');
                    }
                    $attendance->status_m= $status_m;
                    $attendance->InTime_Human= $InTime_Human;
                    $attendance->OutTime_Human= $OutTime_Human;
                    $attendance->Duration_Human= $Duration_Human;
                    $attendance->Date_Human= $Date_Human;
                 }
              return $attendance_logs;
    }
    public function attendance_logs($user_id){
        $attendances=  AttendanceLog::select(array(
            'user_id','attendance_date as Date','check_in as InTime','check_out as OutTime', 
            DB::raw("TIMEDIFF(check_out,check_in)Duration")))
                    ->where('user_id',$user_id)
                    ->orderBy('id', 'DESC')
                    ->get();
        return $attendances;
    } 
    public function attendance_logs_datewise($user_id,$attendance_date){
        $attendances=  AttendanceLog::select(array(
            'user_id','attendance_date as Date','check_in as InTime','check_out as OutTime', 
            DB::raw("TIMEDIFF(check_out,check_in)Duration")))
                    ->where('user_id',$user_id)
                    ->whereDate('attendance_date',$attendance_date)
                    ->orderBy('id', 'DESC')
                    ->get();
        return $attendances;
    }

    public function index()
    {
        $last_attendance=AttendanceLog::where('user_id',Auth::user()->id)
                    ->whereDate('attendance_date',Carbon::today()->toDateString())
                    ->orderBy('id', 'DESC')
                    ->first();
            // dd($las);
            if (!is_null($last_attendance)) {
               $last_row=$last_attendance;
            }else{
                $last_row="";
            }

        $attendances= $this->attendance_logs(Auth::user()->id);
                            // dd($attendances);
        $attendances=$this->AttendanceDataHuman($attendances);
        // dd($attendances);

        $todaysAttendance=AttendanceLog::where('user_id',Auth::user()->id)
                            ->whereDate('attendance_date',Carbon::today()->toDateString())
                            ->first();
                        // dd($todaysAttendance);
        // dd($todaysAttendance);
        return view('admin.pages.own_attendance',compact('attendances','todaysAttendance','last_row'));
    }
  public function drawDataTable()
    {
    
        $attendances= AttendanceLog::where('user_id',Auth::user()->id)
                    ->orderBy('attendance_date', 'DESC')
                    ->get();
                        // dd($todaysAttendance);
        return response()->json([
                'attendance'=>$attendances
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function log_single(Request $request)
    {
        //
         $attendances=$this->attendance_logs_datewise($request->user_id,$request->attendance_date);
         $attendances=$this->AttendanceDataHuman($attendances);
        if ($attendances) {
             return response()->json([
                'success'=>true,
                'attendances'=>$attendances
            ]);
        }else{
             return response()->json([
                'success'=>false,
                'message'=>'Log Not Available'
            ]);
        }
    }
    public function attendance_today()
    {
         $today=Carbon::now();
         $todaysAttendance=AttendanceLog::where('user_id',Auth::user()->id)
                            ->whereDate('attendance_date',Carbon::today()->toDateString())
                            ->first();
            if ($todaysAttendance) {
           return response()->json([
                'attendance'=>$todaysAttendance
            ]);
            }else{
                 return response()->json([
                'attendance'=>null
            ]);
            }


    }   
    public function checked_logged_user_attendance_today()
    {
         $todaysAttendance=AttendanceLog::where('user_id',Auth::user()->id)
                          ->whereDate('attendance_date',Carbon::today()->toDateString())
                          ->first();
            if ($todaysAttendance) {
                    return $todaysAttendance->id;
            }else{
                return false;
            }

    }
   
    public function find_last_status(){
        $last_row=AttendanceLog::where('user_id',Auth::user()->id)
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

     public function check_in()
    {
            if ($this->find_last_status()) {
                // $find_last_status=$this->find_last_status();
                 // dd($find_last_status);
                // dd($this->find_last_status()->check_in);
                 if (!is_null($this->find_last_status()->check_out))
                   {
                    // dd($last_row);
                 $attendance = new AttendanceLog();
                 $attendance->user_id=Auth::user()->id;
                 $attendance->attendance_date=Carbon::now();
                 $attendance->check_in= Carbon::Now()->toTimeString();
                 $attendance->save();
                 if ($attendance) {
                     return response()->json([
                            'success'=>true,
                            'attendance'=>$attendance
                        ]);

                 }
                   } else{
                   return response()->json([
                            'success'=>false,
                            'message'=>"You are already In!! First Checkout "
                        ]);
                   }

            }else{
                  // dd("find last status false! No Data Yet");
                $attendance= new  AttendanceLog();
                $attendance->user_id=Auth::user()->id;
                $attendance->attendance_date=Carbon::now();
                $attendance->check_in= Carbon::Now()->toTimeString();
                $attendance->save();
                if ($attendance) {
                     return response()->json([
                            'success'=>true,
                            'attendance'=>$attendance
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
                 $attendance->user_id=Auth::user()->id;
                 $attendance->attendance_date=Carbon::now();
                 $attendance->check_out=Carbon::Now()->toTimeString();
                 $attendance->save();
                 if ($attendance) {
                     return response()->json([
                            'success'=>true,
                            'attendance'=>$attendance
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
    // for store attendance
      public function is_attendance_exist($user_id,$attendance_date){
         $exist_or_not=  Attendance::where('user_id',$user_id)
                        ->whereDate('attendance_date',$attendance_date)
                        ->pluck('attendance_date')
                        ->toArray();
                 return $exist_or_not;
    }
    // for single attenadance
    public function single_attendance_index(){
            $usersList=User::select(\DB::raw("CONCAT(first_name,' ',middle_name,' ',last_name) AS FullName"),"id")->get()->toArray();
       return view('admin.pages.add_single_attendance',compact('usersList'));
    } 
    public function single_attendance_store(Request $request){
        $total_number_of_row=count($request->user);
       // if any of them exist        
        for($j=0;$j<$total_number_of_row;$j++){
            $user_id=$request->user[$j];
            $attendance_date=$request->attendance_date[$j];
             if ($this->is_attendance_exist($user_id,$attendance_date)) {
                return response()->json([
                            'success'=>false,
                            'message'=>"Attendancce Allready Exist"
                        ]);
            }
        }
        // end existance checking

        for($i=0;$i<$total_number_of_row;$i++){
         
            // $ok=$request->user[$i];

            $user_id=$request->user[$i];
            $attendance_date=$request->attendance_date[$i];
            // dd($attendance_date);
             // $attendance_date= Carbon::createFromFormat('d/m/Y', $request->attendance_date[$i])->format('Y-m-d');
            $check_in=$request->check_in[$i];
            $check_out=$request->check_out[$i];
            $status=$request->status[$i];
            if (is_null($status)) {
                if ($check_in<='10:10:10'){
                   $final_status="InTime";
                }else{
                    $final_status="Late";
                }
            }else{
                $final_status=$status;
            }
                $attendance= New AttendanceLog();
                $attendance->user_id=$user_id;
                $attendance->attendance_date=$attendance_date;
                $attendance->check_in=$check_in;
                $attendance->check_out=$check_out;
                $attendance->status=$final_status;
                $attendance->save();
          

        }
        // end of for loop
           return response()->json([
                            'success'=>true,
                            'message'=>"Attendancce Added success fully"
                        ]);

    }

  
}
