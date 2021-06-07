@extends('layouts.app')
@section('content')
    @include('layouts.header')
    <div id="about" class="row" style="font-family:courier;  margin-top: 150px; ">
        <div class="col-6" style="margin-top: 50px">
            <img style="width: 100%; margin : 5% " src="./img/intro.png ">
        </div>
        <div class="col-6" style="margin-top: 150px; background-color:white; ">
            <h3> Human Pose Estimate Website</h3>
            <p><i>
                    The website counts the number of movements of each exercise that you practice every day, provides a tool
                    to help you track your training progress.
                </i></p>
            <a href="{{route('exercise')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-3">Join with Us</a>
        </div>
    </div>
    <div class="row bg-light">
        <img class="center" style="width: 80%;" src="./img/intro2.png ">
    </div>
    <div class="row">
        <div class="col-4 content">
            <b>Various exercises</b>
        </div>
        <div class="col-4 content" style="border-left: 0.5px solid #5a5c69; border-right: 0.5px solid #5a5c69">
            <b>Using machine learning to support realtime counting</b>
        </div>
        <div class="col-4 content">
            <b>Keep track of your exercise regimen</b>
        </div>
    </div>
    <div style="font-family:courier; text-align: center; margin-bottom: 50px;">
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-3">Register Now</a>
    </div>
    @include('layouts.footer')
@endsection
