@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Create new card') }}</h4>
        <small>{{ __('Scan the key that accomodation gave to you') }}</small>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <ul class="list-group">
        <li class="list-group-item py-4">
            <div class="d-flex flex-column mb-3 flex-grow-1">
                <form action="{{ url('cards/create') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="name" type="text" class="form-control" placeholder="{{ __('An easy name to tag this card')}}" required>
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="node_id" type="text" class="form-control" placeholder="{{ __('Node ID')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="key" type="text" class="form-control" placeholder="{{ __('Node key')}}" required>
                        </div>
                    </div>-->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 border p-0">
                                <video  id="qrVideo" class="d-none" autoplay="true" ></video>
                                <canvas id="qrVideoCanvas" class="w-100 rounded-lg shadow-lg"></canvas>
                                <canvas id="qrShotCanvas"  class="w-100 rounded-lg shadow-lg" style="display:none;"></canvas>
                            </div>
                            <div class="col-lg-6 border px-5 align-self-center d-flex justify-content-center">
                                <div class="">
                                    <h4 class="my-1 text-muted">{{ __('QR scanner') }}</h4>
                                    <div id="qrStatus" class="border border danger p-5"></div>
                                <div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    <small class="mt-4 form-text text-muted">{{ __('For your security, the key will be hidden forever') }}</small>
                </form>
            </div>
        </li>
    </ul>

@endsection

@push('scripts')
    <script>
        // Draw the image with a square in the middle
        function drawImge(){
            function drawImge(){
            let video  = qrVideo;
            let canvas = qrVideoCanvas;
            let ctx    = canvas.getContext('2d');

            canvas.width     = video.videoWidth;
            canvas.height    = video.videoHeight;

            // Draw the image
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

            let qrArea   = 300;
            let pX       = canvas.width/2 - qrArea/2;
            let pY       = canvas.height/2 - qrArea/2;

            // Create overlay and erase a square
            ctx.fillStyle = "rgba(238, 238, 238, 0.5)";
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.clearRect(pX, pY, qrArea, qrArea);

            // Redraw a square of image
            ctx.drawImage(video, pX, pY, qrArea, qrArea, pX, pY, qrArea, qrArea);

            // Write instructions
            let fontIcon = 'touch_app';
            let fontWidth;
            let fontHeight;

            material_font.load().then( () => {
                ctx.fillStyle = 'rgba(238, 238, 238, 1)';
                ctx.font   = '6em material-icons';
                ctx.textBaseline = "top";
                fontWidth  = ctx.measureText(fontIcon).width;
                fontHeight = parseInt(ctx.font) * 1.2;
                ctx.fillText(
                    fontIcon,
                    (canvas.width-fontWidth),
                    (canvas.height-fontHeight)
                );
            }).catch( console.error );

            setTimeout(drawImge , 100);
        }

        // Select media elements we are transforming
        var qrVideo       = document.querySelector("#qrVideo");
        var qrVideoCanvas = document.querySelector("#qrVideoCanvas");
        var qrShotCanvas  = document.querySelector('#qrShotCanvas');
        var qrStatuss     = document.querySelector('#qrStatus');
        var front         = false;
        const material_font = new FontFace(
            'material-icons',
            'url(https://fonts.gstatic.com/s/materialicons/v48/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2)'
        );

        // add it to the document's FontFaceSet
        document.fonts.add( material_font ); 

        // Check for webcam support
        if (navigator.mediaDevices.getUserMedia) {

            // Broadcast the video to the element or show error
            navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: (front? "user" : "environment")
                }
            })
            .then(function (stream) {
                qrVideo.srcObject = stream;
                qrVideo.onplay = function() {
                    setTimeout(drawImge , 300);
                };
            })
            .catch(function ( error ) {
                console.log("Something went wrong!", error);
            });
        }

        qrVideoCanvas.onclick = function() {

            // Place the pic placeholder where the video was
            qrVideoCanvas.style.display = 'none';
            qrShotCanvas.style.display  = 'block';

            // Draw the pic in the placeholder
            qrShotCanvas.width  = qrVideo.videoWidth;
            qrShotCanvas.height = qrVideo.videoHeight;
            qrCtx = qrShotCanvas.getContext('2d');
            qrCtx.drawImage(qrVideoCanvas, 0, 0);

            // Inform the user about the actions
            qrStatus.innerHTML = 'Sending...';

            qrShotCanvas.toBlob(function(blob) {
                const formData = new FormData();
                formData.append('file', blob, 'filename.png');

                // Post via axios or other transport method
                fetch('https://api.qrserver.com/v1/read-qr-code/', {
                method: 'POST',
                body: formData,
                })
                .then(function(response) {
                    // Request failed
                    if (response.status !== 200) {
                        console.log('Looks like there was a problem. Status Code: ' +
                        response.status);
                        return;
                    }

                    // Request successful
                    response.json().then(function(data) {
                        
                        console.log(data);

                        // Not possible to process the QR
                        if ( data[0].symbol[0].error != null ){
                            qrStatus.innerHTML = 'Not possible to extract the card';
                            return;
                        }

                        let qrData = data[0].symbol[0].data;

                        // Not a right QR code
                        if( qrData.match(/[a-z0-9]{64}[@]{1}[0-9]+/) == null ){
                            qrStatus.innerHTML = 'This is not a disttant card';
                            return;
                        }

                        // Possible valid card
                        qrStatus.innerHTML = 'That is a good card';
                        console.log('Good QR', qrData);

                    });

                }).catch(function(err) {
                    console.log('Fetch Error :-S', err);
                });
            });
        };

        qrShotCanvas.onclick = function() {
            qrVideoCanvas.style.display = 'block';
            qrShotCanvas.style.display  = 'none';

            qrStatus.innerHTML = '';
        };

    </script>
@endpush