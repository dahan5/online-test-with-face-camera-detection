@extends('layout')
@section('content')

    <div  style="position: fixed; bottom: 0; left: 0; width: 100%;">
        <div class="alert alert-warning" style="margin-bottom: 0px">
            <strong>Attention</strong> <br>
            Please make sure you press the Allow/Yes button when requesting video record / webcam in your browser. <br>
            - Make sure your face is visible on the webcam camera. <br>
            - Remove the glasses for a moment when they cannot be scanned, until a green box appears
        </div>

        <div class="alert alert-info" style="margin-bottom: 0px">
            <div id="status" class="text-center">
                Please wait for the face & eye scan...
            </div>
        </div>
    </div>


    <div id="face-detector-area"></div>
    @push("bottom")
        <script src="{{ asset('asset/webgazer.min.js') }}" type="text/javascript"></script>
        <script>
            jQuery.fn.center = function () {
                this.css("position","absolute");
                this.css("top", "50px");
                this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                    $(window).scrollLeft()) + "px");
                return this;
            }

            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }

            var targetObj = {};
            var targetProxy = new Proxy(targetObj, {
                set: function (target, key, value) {
                    if(key === 'face_detected' && value === true) {
                        faceDetected();
                    }
                    console.log(`${key} set to ${value}`);
                    target[key] = value;
                    return true;
                }
            });

            async function faceDetected()
            {
                $("#status").html("<strong>Face and Eyes detected</strong><br/>You will be directed to the test form shortly...");
                setTimeout(async()=>{
                    await $.post("{{ url('api/eye-test-completed') }}");
                    location.href = '{{ url('form-test') }}';
                },1500);
            }

            let timeout = null;
            let xPred = null;
            let yPred = null;
            let eyeCatch = false;
            let eyeLost = false;

            async function main() {
                await webgazer.setGazeListener(function(data, elapsedTime) {
                    if (data == null) {
                        return;
                    }
                    xPred = data.x; //these x coordinates are relative to the viewport
                    yPred = data.y; //these y coordinates are relative to the viewport
                    eyeCatch = true;
                }).begin();

                let check = setInterval(async ()=> {
                    if(eyeCatch) {
                        let inside = $("#webgazerFaceFeedbackBox").attr('style');
                        if(inside && inside.includes("solid green") && xPred && yPred) {
                            console.log("Face inside");
                            targetProxy.face_detected = true;
                            clearInterval(check);
                        }

                        $("html,body").attr("style","overflow: hidden").focus();
                    }
                },2500);

                let check2 = setInterval(async ()=>{
                    $("#webgazerVideoContainer").center();
                }, 100);
            }

            main();


        </script>
    @endpush
@endsection
