<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\SubDepartment;
use App\Company;
use App\User;
use App\Attendance;
use Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
class OldApproveAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
       // get super admin un approved attendace
        if (Auth::user()->hasRole('super-admin')) {
            $attendances= Attendance::whereDate('attendance_date',Carbon::today()->toDateString())
                        ->where('isApproved_s',0)
                        ->with(['user' => function($q)
                            {
                                $q->select('first_name','middle_name','last_name', 'id');
                            }])->get();
            $unapproved_dates= Attendance::where('isApproved_s',0)
                        ->distinct('DATE(attendance_date)')
                        ->get([DB::raw('DATE(attendance_date) as attendance_date')]);
                // dd($unapproved_dates);
        }
       // $date=Carbon::today()->toDateString()

        return view('admin.pages.approve_attendance',compact('attendances','unapproved_dates'));
    }
    public function approved_by_superAdmin(Request $request)
    {
        //
        // dd($request->hidden_entry_ids);
        $total_entry=count($request->hidden_entry_ids);
        for ($i=0; $i<$total_entry ; $i++) {
                 $InTime=$request->check_in[$i];
                if ($InTime<'10:10:10') {
                        $check_status='in time';
                    }else{
                         $check_status='late';
                    }

                $attendance=Attendance::find($request->hidden_entry_ids[$i]);
                $attendance->check_in=$request->check_in[$i];
                $attendance->check_out=$request->check_out[$i];
                $attendance->status=$check_status;
                $attendance->isApproved_s=1;
                $attendance->update();
        }
        return response()->json([
                'success'=>true
            ]);

    }
    public function find_unApproved_superAdmin_attendance(Request $request)
    {
        $SearchDate= Carbon::createFromFormat('d/m/Y', $request->SearchDate)->format('Y-m-d');
        $attendances= Attendance::whereDate('attendance_date',$SearchDate)
                        ->where('isApproved_s',0)
                        ->with(['user' => function($q)
                            {
                                $q->select('first_name','middle_name','last_name', 'id');
                            }])->get();
            if ($attendances) {
               return response()->json([
                'attendances'=>$attendances
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
