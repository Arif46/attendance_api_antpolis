<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\SubDepartment;
use App\Company;
use App\User;
use App\OldAttendance;
use Auth;
use Carbon\Carbon;
class OldAttendanceController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $attendances= OldAttendance::where('user_id',Auth::user()->id)
                    ->orderBy('attendance_date', 'ASC')
                    ->get();
        $todaysAttendance=OldAttendance::where('user_id',Auth::user()->id)
                            ->whereDate('attendance_date',Carbon::today()->toDateString())
                            ->first();
                        // dd($todaysAttendance);
        // dd($todaysAttendance);
        return view('admin.pages.own_attendance',compact('attendances','todaysAttendance'));
    }
  public function drawDataTable()
    {
    
        $attendances= OldAttendance::where('user_id',Auth::user()->id)
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
    public function create()
    {
        //
    }
    public function attendance_today()
    {
         $today=Carbon::now();
         $todaysAttendance=OldAttendance::where('user_id',Auth::user()->id)
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
         $todaysAttendance=OldAttendance::where('user_id',Auth::user()->id)
                          ->whereDate('attendance_date',Carbon::today()->toDateString())
                          ->first();
            if ($todaysAttendance) {
                    return $todaysAttendance->id;
            }else{
                return false;
            }


    }
     public function check_in()
    {
        $attendance= new  OldAttendance();
        $currentTime=Carbon::Now()->toTimeString();
        if ($currentTime<'10:10:10') {
            $check_status='in time';
        }else{
             $check_status='late';
        }


        // $attendance = $attendance->updateOrCreate(
        //             ['user_id' =>Auth::user()->id,
        //             'attendance_date'=>$todaysDatetime
        //          ]
        //         );
        $attendance=OldAttendance::where('user_id',Auth::user()->id)
                            ->whereDate('attendance_date',Carbon::today()->toDateString())
                            ->first();
        if (!is_null($attendance)) {
              $attendance->check_in= Carbon::Now();
              $attendance->status= $check_status;
              if ($attendance->save()) {
                   return response()->json([
                        'attendance'=>$attendance
                    ]);
              }
        }else{
             $attendance_n= new  OldAttendance();
             $attendance_n->attendance_date= Carbon::today()->toDateString();
             $attendance_n->check_in= Carbon::Now()->toTimeString();
             $attendance_n->status= $check_status;
             $attendance_n->user_id=Auth::user()->id;
              if ($attendance_n->save()) {
                   return response()->json([
                        'attendance'=>$attendance_n
                    ]);
              }
        }
       // $attendance= OldAttendance::where('user_id',Auth::user()->id)
       //      ->where('attendance_date', $todaysDateForDB)
       //      ->first();
        // if ($this->checked_logged_user_attendance_today()) {
              
        // }else{
        //     return false;
        // }


    }
    public function check_out()
    {

       $attendance= OldAttendance::where('user_id',Auth::user()->id)
            ->whereDate('attendance_date', Carbon::today()->toDateString())
            ->first();
        $attendance->check_out= Carbon::now()->toTimeString();
      if ($attendance->save()) {
           return response()->json([
                'attendance'=>$attendance
            ]);
      }

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
