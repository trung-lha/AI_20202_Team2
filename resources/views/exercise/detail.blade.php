@extends('layouts.sidebar')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="icon" href="favicon.ico">
<link rel="stylesheet" type="text/css" href="{{ asset('css/control_utils.css') }}">
<script src="{{ asset('js/camera_utils.js') }}"></script>
<script src="{{ asset('js/control_utils.js') }}"></script>
<script src="{{ asset('js/drawing_utils.js') }}"></script>
<script src="{{ asset('js/pose.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@section('contents')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 ml-5">Exercises - {{ $detail[0]->name }}</h1>
    </div>
    <div class="container" style="margin: 0  0 2em 10%;">
        <video class="input_video"></video>
        <canvas class="output_canvas" width="1280px" height="720px"></canvas>
        <!-- <canvas class="counter_canvas" width="200px" height="720px"></canvas> -->
        <div class="loading">
            <div class="spinner"></div>
            <div class="message">
                Loading
            </div>
        </div>
        <a class="abs logo" href="https://github.com/baoanh1310/pose_demo" target="_blank">
            <div style="display: flex;align-items: center;bottom: 0;right: 10px;">
                <img class="logo" src="logo_white.png" alt="" style="height: 50px;">
                <span class="title">Group 02 - AI Project</span>
            </div>
        </a>
        <div class="shoutout">
            <div>
                <a href="https://github.com/baoanh1310/pose_demo">
                    Click here for more info
                </a>
            </div>
        </div>
        <div class="control-panel">
        </div>
    </div>
    <div>
        <form class="user" id="save_form" method="POST" action="{{ route('exercise-save') }}">
            @csrf
            <input type="hidden" id="count_save" name="counter">
            <input type="hidden" id="exercise_id" name="exercise_id" value="{{$detail[0]->exercise_id}}">
            <a ref="javascript:{}" onclick="document.getElementById('save_form').submit();" class="btn btn-danger btn-icon-split" style="align-content: center; margin: 0 0 0 1em">
                <span class="icon text-white-50">
                    <i class="fas fa-stopwatch"></i>
                </span>
                <span>Stop exercise</span>
            </a>
        </form>
    </div>
    
    <script>
        // Our input frames will come from here.
        const videoElement = document.getElementsByClassName('input_video')[0];
        const canvasElement = document.getElementsByClassName('output_canvas')[0];
        const controlsElement = document.getElementsByClassName('control-panel')[0];
        const canvasCtx = canvasElement.getContext('2d');
    
        // const counterElement = document.getElementsByClassName('counter_canvas')[0];
        // const canvasCounter = counterElement.getContext('2d');
    
        // We'll add this to our control panel later, but we'll save it here so we can
        // call tick() each time the graph runs.
        const fpsControl = new FPS();
    
        // Optimization: Turn off animated spinner after its hiding animation is done.
        const spinner = document.querySelector('.loading');
        spinner.ontransitionend = () => {
            spinner.style.display = 'none';
        };
    
        // Curl counter stuff
        let angle = 0.0;
        let stage = "DOWN";
        let counter = 0;
    
        function zColor(data) {
            return 'white';
        }
    
        function calculate_angle(shoulder, elbow, wrist) {
            let radians = Math.atan2(wrist[1] - elbow[1], wrist[0] - elbow[0]) -
                Math.atan2(shoulder[1] - elbow[1], shoulder[0] - elbow[0]);
            let angle = Math.abs(radians * 180.0 / Math.PI);
    
            if (angle > 180.0) {
                angle = 360 - angle;
            }
    
            return angle;
        }
    
        function onResults(results) {
            // Hide the spinner.
            document.body.classList.add('loaded');
    
            // Update the frame rate.
            fpsControl.tick();
    
            // Draw the overlays.
            canvasCtx.save();
            canvasCtx.clearRect(0, 0, canvasElement.width, canvasElement.height);
            canvasCtx.drawImage(
                results.image, 0, 0, canvasElement.width, canvasElement.height);
            drawConnectors(
                canvasCtx, results.poseLandmarks, POSE_CONNECTIONS, {
                    visibilityMin: 0.65,
                    color: 'white'
                });
            drawLandmarks(
                canvasCtx,
                Object.values(POSE_LANDMARKS_LEFT)
                .map(index => results.poseLandmarks[index]), {
                    visibilityMin: 0.65,
                    color: zColor,
                    fillColor: 'rgb(255,138,0)'
                });
            drawLandmarks(
                canvasCtx,
                Object.values(POSE_LANDMARKS_RIGHT)
                .map(index => results.poseLandmarks[index]), {
                    visibilityMin: 0.65,
                    color: zColor,
                    fillColor: 'rgb(0,217,231)'
                });
            drawLandmarks(
                canvasCtx,
                Object.values(POSE_LANDMARKS_NEUTRAL)
                .map(index => results.poseLandmarks[index]), {
                    visibilityMin: 0.65,
                    color: zColor,
                    fillColor: 'white'
                });
            // canvasCtx.restore();
    
            const landmarksRight = Object.values(POSE_LANDMARKS_LEFT)
                .map(index => results.poseLandmarks[index]);
    
            const shoulder = [landmarksRight[5].x, landmarksRight[5].y];
            const elbow = [landmarksRight[6].x, landmarksRight[6].y];
            const wrist = [landmarksRight[7].x, landmarksRight[7].y];
    
            angle = calculate_angle(shoulder, elbow, wrist);
    
            // console.log(angle);
            if (angle > 140) {
                stage = "DOWN";
            }
            if (angle < 30 && stage == "DOWN") {
                stage = "UP";
                counter += 1;
                // console.log(stage + ", ", counter);
            }
            console.log("Angle: " + angle + ", Stage: " + stage + ", ", counter);
            
            document.getElementById("count_save").setAttribute('value', counter);

            canvasCtx.font = "30px Arial";
            canvasCtx.fillStyle = "red";
            canvasCtx.fillText(stage + ": " + counter.toString(), 1100, 50);
            canvasCtx.restore();
        }
    
        const pose = new Pose({
            locateFile: (file) => {
                return `https://cdn.jsdelivr.net/npm/@mediapipe/pose@0.3.1621277220/${file}`;
            }
        });
        pose.onResults(onResults);
    
        /**
         * Instantiate a camera. We'll feed each frame we receive into the solution.
         */
        const camera = new Camera(videoElement, {
            onFrame: async () => {
                await pose.send({
                    image: videoElement
                });
            },
            width: 1280,
            height: 720
        });
        camera.start();
    
        // Present a control panel through which the user can manipulate the solution
        // options.
        new ControlPanel(controlsElement, {
                selfieMode: true,
                modelComplexity: 0,
                smoothLandmarks: true,
                minDetectionConfidence: 0.2,
                minTrackingConfidence: 0.2
            })
            .add([
                new StaticText({
                    title: 'Curl Counter Mode'
                }),
                fpsControl,
                new Toggle({
                    title: 'Right Hand Practice',
                    field: 'selfieMode'
                }),
                // new Slider({
                //     title: 'Model Complexity',
                //     field: 'modelComplexity',
                //     discrete: ['Lite', 'Full', 'Heavy'],
                // }),
                // new Toggle({ title: 'Smooth Landmarks', field: 'smoothLandmarks' }),
                // new Slider({
                //     title: 'Min Detection Confidence',
                //     field: 'minDetectionConfidence',
                //     range: [0, 1],
                //     step: 0.01
                // }),
                // new Slider({
                //     title: 'Min Tracking Confidence',
                //     field: 'minTrackingConfidence',
                //     range: [0, 1],
                //     step: 0.01
                // }),
            ])
            .on(options => {
                videoElement.classList.toggle('selfie', options.selfieMode);
                pose.setOptions(options);
            });    
    </script>
@endsection
