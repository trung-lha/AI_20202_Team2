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
        return view('exercise\detail', compact('detail'));
    }

    public function exercise_save(Request $request)
    {
        
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
        
        // dd($data[0]);
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
}
