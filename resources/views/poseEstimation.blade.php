{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html> --}}
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <meta charset="utf-8">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" type="text/css" href="{{asset('css/control_utils.css')}}">
    <script src="{{asset('js/camera_utils.js')}}"></script>
    <script src="{{asset('js/control_utils.js')}}"></script>
    <script src="{{asset('js/drawing_utils.js')}}"></script>
    <script src="{{asset('js/pose.js')}}"></script>
</head>

<body>
    <div class="container">
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
                <img class="logo" src="logo_white.png" alt="" style="
          height: 50px;">
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
    </div>
    <div class="control-panel">
    </div>
</body>
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
  let radians = Math.atan2(wrist[1]-elbow[1], wrist[0]-elbow[0]) - 
    Math.atan2(shoulder[1]-elbow[1], shoulder[0]-elbow[0]);
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
        .map(index => results.poseLandmarks[index]), { visibilityMin: 0.65, color: zColor, fillColor: 'rgb(255,138,0)' });
    drawLandmarks(
        canvasCtx,
        Object.values(POSE_LANDMARKS_RIGHT)
        .map(index => results.poseLandmarks[index]), { visibilityMin: 0.65, color: zColor, fillColor: 'rgb(0,217,231)' });
    drawLandmarks(
        canvasCtx,
        Object.values(POSE_LANDMARKS_NEUTRAL)
        .map(index => results.poseLandmarks[index]), { visibilityMin: 0.65, color: zColor, fillColor: 'white' });
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
        await pose.send({ image: videoElement });
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
        new StaticText({ title: 'Curl Counter Mode' }),
        fpsControl,
        new Toggle({ title: 'Right Hand Practice', field: 'selfieMode' }),
        new Slider({
            title: 'Model Complexity',
            field: 'modelComplexity',
            discrete: ['Lite', 'Full', 'Heavy'],
        }),
        new Toggle({ title: 'Smooth Landmarks', field: 'smoothLandmarks' }),
        new Slider({
            title: 'Min Detection Confidence',
            field: 'minDetectionConfidence',
            range: [0, 1],
            step: 0.01
        }),
        new Slider({
            title: 'Min Tracking Confidence',
            field: 'minTrackingConfidence',
            range: [0, 1],
            step: 0.01
        }),
    ])
    .on(options => {
        videoElement.classList.toggle('selfie', options.selfieMode);
        pose.setOptions(options);
    });
</script>

</html>