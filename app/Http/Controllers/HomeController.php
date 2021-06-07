<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercise;
use App\Workout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function exercise()
    {   
        $exercises = Exercise::orderBy('exercise_id')->get();
        // dd($exercises);
        return view('exercise\exercises', compact('exercises'));
    }

    public function exercise_detail($exercise_name)
    {
        $detail = Exercise::where('name',$exercise_name)->get();
        // dd($detail);
        if($detail[0]->name == 'Crunch')
            return view('exercise\squat', compact('detail'));
        elseif($detail[0]->name == 'Lift Weights')
            return view('exercise\curl', compact('detail'));
        elseif($detail[0]->name == 'Squat')
            return view('exercise\squat', compact('detail'));
        else
            return view('exercise\push_up', compact('detail'));
        // dd($detail);
    }

    public function exercise_save(Request $request)
    {
        // dd($request);
        $data = Workout::where([
                ['user_id',Auth::user()->id],['exercise_id',$request->exercise_id]
            ])->get();
        if(empty($data->all())){
            $data[] = [
                'user_id' => Auth::user()->id,
                'exercise_id' => $request->exercise_id,
                'counts' => $request->counter,
                'time' => 1
            ];
            Workout::insert($data[0]);
        }else{
            $data[0]->counts += $request->counter;
            $data[0]->time +=1; 
            Workout::where([
                ['user_id',Auth::user()->id],['exercise_id',$request->exercise_id]
            ])->update($data[0]->toArray());
        }

        $detail[] = [
            'user_id' => Auth::user()->id,
            'exercise_id' => $request->exercise_id,
            'count' => $request->counter,
            'time' => $request->timer,
            'date' => date("Y-m-d"),
        ];
        DB::table('detai_workout')->insert($detail);
        // dd($detail);
        return \redirect()->action([HomeController::class, 'workout']);
    }

    public function workout()
    {   
        $exercises = Exercise::
            leftjoin('workout','exercises.exercise_id','=','workout.exercise_id')
            ->where('workout.user_id',Auth::user()->id)
            ->orderBy('exercises.exercise_id')->get();
        
        // dd($exercises);
        return view('exercise\workout', compact('exercises'));
    }

    public function workout_detail()
    {   
        $exercises = DB::table('detai_workout')
            ->leftjoin('exercises','exercises.exercise_id','=','detai_workout.exercise_id')
            ->where('detai_workout.user_id',Auth::user()->id)
            ->orderBy('exercises.exercise_id')->get();
        
        
        return view('exercise\detail_workout', compact('exercises'));
    }
}
