@extends('layouts.sidebar')

@section('contents')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 ml-5">Exercises</h1>
</div>
    @foreach ($exercises as $item)
    
    <div class="container" style="margin: 0  0 2em 10%;">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-info text-uppercase mb-1">{{$item->name}}
                        </div>
                    </div>
                    <div class="col-auto">
                        
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
                <div class="card-body" style="margin: -0.8em 0 -1.2em 0;">
                    {{$item->description}}
                </div>
                <a href="{{route('exercise-detail',["exercise_name"=>$item->name])}}" class="btn btn-info btn-icon-split" style="margin: 0 0 -1.2em 0;">
                    <span class="icon text-white-50">
                        <i class="fas fa-dumbbell"></i>
                    </span>
                    <span class="text">Let's exercise</span>
                </a>
            </div>
        </div>
    </div>
    @endforeach
@endsection
