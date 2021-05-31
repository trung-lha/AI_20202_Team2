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
        // dd($request->all());
        return \redirect()->action([HomeController::class, 'workout']);
    }

    public function workout()
    {   
        $workout = Workout::
            join('exercises','workout.exercise_id','=','exercises.exercise_id')
            ->where('user_id',Auth::user()->id)->get()->toArray();
        
        $exercises = Exercise::get();
        return view('exercise\workout', compact('workout','exercises'));
    }
}
