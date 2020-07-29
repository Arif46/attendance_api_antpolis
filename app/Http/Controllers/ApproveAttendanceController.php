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
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class ApproveAttendanceController extends Controller
{
             public function __construct()
            {
                $this->middleware(['role:super-admin']);
            }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function find_unapproved_dates_sa(){
    	 $unapproved_dates_logs= AttendanceLog::where('is_approved_s',0)
                        ->distinct('DATE(attendance_date)')
                        ->get([DB::raw('DATE(attendance_date) as attendance_date')])
                        ->pluck('attendance_date')
                        ->toArray();
          // $unapproved_dates_at =Attendance::where('is_approved_s',1)
          //               ->distinct('DATE(attendance_date)')
          //               ->get([DB::raw('DATE(attendance_date) as attendance_date')])
          //               ->pluck('attendance_date')
          //               ->toArray();
          //       $result_array_diff=array_diff($unapproved_dates_logs,$unapproved_dates_at);
          //       if ($result_array_diff) {
          //       	$unapproved_dates=$result_array_diff;
          //       }else{
          //       	$unapproved_dates=null;
          //       }
             // return $unapproved_dates;                        
             return $unapproved_dates_logs;                        
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
			     	$attendance->status_m= $status_m;
			     	$attendance->InTime_Human= $InTime_Human;
			     	$attendance->OutTime_Human= $OutTime_Human;
			     	$attendance->Duration_Human= $Duration_Human;
			     }
			  return $attendance_logs;
    }
    public function index()
    {
        $attendance_logs= AttendanceLog::select(array(
            'user_id','attendance_date as Date', 
            DB::raw("MIN(check_in)InTime,MAX(check_out)OutTime")))
                    ->whereDate('attendance_date',Carbon::today()->toDateString())
                    ->groupBy(DB::raw("Date(attendance_date)"),'user_id')
                    ->get();
     $attendances_details=$this->AttendanceDataHuman($attendance_logs);
     $unapproved_dates=$this->find_unapproved_dates_sa();

      
        return view('admin.pages.approve_attendance',compact('attendances_details','unapproved_dates'));
    }
    public function is_attendance_exist($user_id,$attendance_date){
    	 $exist_or_not=  Attendance::where('user_id',$user_id)
    	 				->where('is_approved_s',1)
                        ->whereDate('attendance_date',$attendance_date)
                        ->pluck('attendance_date')
                        ->toArray();
                        return $exist_or_not;
    }
    public function approved_by_superAdmin(Request $request)
    {
        $total_entry=count($request->hidden_user_id);
        for ($i=0; $i<$total_entry ; $i++){
    	$check_exist= $this->is_attendance_exist($request->hidden_user_id[$i],$request->hidden_attendance_date);
             if (empty($check_exist)) {
                $attendance= new Attendance();
                $attendance->attendance_date=$request->hidden_attendance_date;
                $attendance->user_id=$request->hidden_user_id[$i];
                $attendance->check_in=$request->check_in[$i];
                $attendance->check_out=$request->check_out[$i];
                $attendance->status=$request->status_admin[$i];;
                $attendance->is_approved_s=1;
                if ($attendance->save()) {
                   // make log table approved
                    AttendanceLog::where('user_id',$request->hidden_user_id[$i])
                    ->whereDate('attendance_date',$request->hidden_attendance_date)
                    ->update(['is_approved_s'=>1]);
                }
             }else{
             	 return response()->json([
                'success'=>false,
                'message'=>'Attendance Allready Exist'
            ]);
             }
        }
        // dd($attendance);
        return response()->json([
                'success'=>true
            ]);

    }
  
    public function find_unApproved_superAdmin_attendance(Request $request)
    {
        $searchDate= $request->searchDate;
        $attendance_logs= AttendanceLog::select(array(
            'user_id','attendance_date as Date', 
            DB::raw("MIN(check_in)InTime,MAX(check_out)OutTime,CONCAT(user.first_name,' ', user.middle_name,' ',user.last_name) AS Name")))
                    ->join("users as user","user.id","=","attendance_logs.user_id")
                    ->whereDate('attendance_date',$searchDate)
                    ->where('is_approved_s',0)
                    ->groupBy(DB::raw("Date(attendance_date)"),'user_id')
                    ->get();
        $attendances_details=$this->AttendanceDataHuman($attendance_logs);
            if ($attendances_details) {
               return response()->json([
                'attendances'=>$attendances_details
            ]);
            }
        
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
