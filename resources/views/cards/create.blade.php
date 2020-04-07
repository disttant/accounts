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
                    <input name="node_id" type="hidden" required>
                    <input name="key" type="hidden" required>
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="name" type="text" class="form-control" placeholder="{{ __('An easy name to tag this card')}}" required a
utofocus>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 p-0 pb-5">
                                <video  id="qrVideo" class="d-none" autoplay="true" ></video>
                                <canvas id="qrVideoCanvas" class="w-100 rounded-lg shadow-sm"></canvas>
                                <canvas id="qrShotCanvas"  class="w-100 rounded-lg shadow-sm" style="display:none;"></canvas>
                            </div>
                            <div class="col-lg-6 p-0 d-flex justify-content-center">
                                <div class="w-100 mx-3">
                                    <h4 class="my-1 px-3 text-muted">{{ __('Instructions') }}</h4>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item border-0 py-3">
                                            <i class="material-icons align-middle mr-2">label</i>
                                            <p class="d-inline lead align-middle">{{ __('Label this card')  }}</p>
                                        </li>
                                        <li class="list-group-item border-0 py-3">
                                            <i class="material-icons align-middle mr-2">stay_primary_portrait</i>
                                            <p class="d-inline lead align-middle">{{ __('Direct your device to the QR')  }}</p>
                                        </li>
                                        <li class="list-group-item border-0 py-3">
                                            <i class="material-icons align-middle mr-2">wallpaper</i>
                                            <p class="d-inline lead align-middle">{{ __('Keep the QR inside the box')  }}</p>
                                        </li>
                                        <li class="list-group-item border-0 py-3">
                                            <i class="material-icons align-middle mr-2">touch_app</i>
                                            <p class="d-inline lead align-middle">{{ __('Touch the screen')  }}</p>
                                        </li>
                                        <li class="list-group-item border-0 py-3">
                                            <i class="material-icons align-middle mr-2">save</i>
                                            <p class="d-inline lead align-middle">{{ __('Save and go!')  }}</p>
                                        </li>
                                    </ul>
                                <div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" disabled>{{ __('Create') }}</button>
                </form>
            </div>
        </li>
    </ul>

@endsection

@push('scripts')
    <script>
        // Select media elements we are transforming
        var qrVideo           = document.querySelector("#qrVideo");
        var qrVideoCanvas     = document.querySelector("#qrVideoCanvas");
        var qrShotCanvas      = document.querySelector('#qrShotCanvas');
        var formSubmitButton  = document.querySelector('button[type="submit"]');
        var formNodeidInput   = document.querySelector('input[name="node_id"]');
        var formKeyInput      = document.querySelector('input[name="key"]');
        var front             = false;
        const material_font   = new FontFace(
            'material-icons',
            'url(https://fonts.gstatic.com/s/materialicons/v48/flUhRq6tzZclQEJ-Vdg-IuiaDsNcIhQ8tQ.woff2)'
        );

        // add it to the document's FontFaceSet
        document.fonts.add( material_font );

        // Draw the image with a square in the middle
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
                    setTimeout(drawImge , 100);
                };
            })
            .catch(function ( error ) {
                console.log("[Disttant QR] Media error!", error);
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

            // Take it as binary
            qrShotCanvas.toBlob(function(blob) {
                const formData = new FormData();
                formData.append('file', blob, 'filename.png');

                // Post via axios or other transport method
                fetch('https://api.qrserver.com/v1/read-qr-code/', {
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {
                    // Write instructions
                    let fontIcon;
                    let fontWidth;
                    let fontHeight;

                    qrCtx.fillStyle    = 'rgba(238, 238, 238, 1)'; //238
                    qrCtx.font         = '15em material-icons';
                    qrCtx.textBaseline = 'middle';
                    fontHeight         = parseInt(qrCtx.font) * 1.2;
                    fontWidth          = parseInt(qrCtx.font) * 1;  // qrCtx.measureText(fontIcon).width;
                    qrShotCenterX      = qrShotCanvas.width/2 - fontWidth/2;
                    qrShotCenterY      = qrShotCanvas.height/2;

                    // Request failed
                    if (response.status !== 200) {
                        fontIcon = 'error';
                        material_font.load().then( () => {
                            qrCtx.fillText(
                                fontIcon,
                                qrShotCenterX,
                                qrShotCenterY
                            );
                        });
                        return;
                    }

                    // Request successful
                    response.json().then(function(data) {

                        // Not possible to process the QR
                        if ( data[0].symbol[0].error != null ){
                            fontIcon = 'close';
                            material_font.load().then( () => {
                                qrCtx.fillText(
                                    fontIcon,
                                    qrShotCenterX,
                                    qrShotCenterY
                                );
                            });
                            return;
                        }

                        let qrData = data[0].symbol[0].data;

                        // Not a right QR code
                        if( qrData.match(/[a-z0-9]{64}[@]{1}[0-9]+/) == null ){
                            fontIcon = 'close';
                            material_font.load().then( () => {
                                qrCtx.fillText(
                                    fontIcon,
                                    qrShotCenterX,
                                    qrShotCenterY
                                );
                            });
                            return;
                        }

                        // Possible valid card
                        fontIcon = 'check';
                        material_font.load().then( () => {
                            qrCtx.fillText(
                                fontIcon,
                                qrShotCenterX,
                                qrShotCenterY
                            );
                        });
                        //.catch( console.error );

                        // Set the key
                        qrData = qrData.split("@");
                        formNodeidInput.value = qrData[1];
                        formKeyInput.value = qrData[0];

                        // Activate the submit button
                        formSubmitButton.removeAttribute("disabled");
                    });
                }).catch(function(err) {
                    //console.log('Fetch Error :-S', err);
                });
            });
        };

        qrShotCanvas.onclick = function() {
            qrVideoCanvas.style.display = 'block';
            qrShotCanvas.style.display  = 'none';

            // Disable the submit button
            formSubmitButton.setAttribute("disabled", "true");
        };
    </script>
@endpush