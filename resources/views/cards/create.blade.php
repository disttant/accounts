@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Create new Comodito') }}</h4>
        <small>{{ __('Put here the data that accomodation gave to you') }}</small>
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
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="node_id" type="text" class="form-control" placeholder="{{ __('Node ID')}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <input name="key" type="text" class="form-control" placeholder="{{ __('Node key')}}" required>
                        </div>
                    </div>
                    <div class="border border-warning">
                        <video autoplay="true" id="qrVideo"></video>
                        <canvas id="qrScreenshot" style="display:none;"></canvas>
                        <div id="qrStatus" class="border border danger p-5"></div>
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
        // Select the element where video will be
        var qrVideo             = document.querySelector("#qrVideo");
        var qrCanvas            = document.querySelector('#qrScreenshot');
        var qrStatuss           = document.querySelector('#qrStatus');
        var front = false;

        // Check for webcam support
        if (navigator.mediaDevices.getUserMedia) {

            // Broadcast the video to the element or show error
            navigator.mediaDevices.getUserMedia({ 
                video: {
                    // width: {
                    //    min: 1280,
                    //    ideal: 1920,
                    //    max: 2560
                    // },
                    // height: {
                    //    min: 720,
                    //    ideal: 1080,
                    //    max: 1440
                    // },
                    facingMode: (front? "user" : "environment")
                } 
            })
            .then(function (stream) {
                qrVideo.srcObject = stream;
            })
            .catch(function ( error ) {
                console.log("Something went wrong!", error);
            });
        }

        

        qrVideo.onclick = function() {
            // Place the pic placeholder where the video was
            qrVideo.style.display = 'none';
            qrCanvas.style.display = 'block';

            // Draw the pic in the placeholder
            qrCanvas.width = qrVideo.videoWidth;
            qrCanvas.height = qrVideo.videoHeight;
            qrCanvas.getContext('2d').drawImage(qrVideo, 0, 0);

            // Other browsers will fall back to image/png
            //img.src = canvas.toDataURL('image/webp');

            // Inform the user about the actions
            qrStatus.innerHTML = 'Sending...';

            // Send the pic to the API
            // Alternative
            // https://file.io/?expires=1w
            // http://api.qrserver.com/v1/read-qr-code/?fileurl=https://file.io/zmFzks
            qrCanvas.toBlob(function(blob) {
                const formData = new FormData();
                formData.append('file', blob, 'filename.png');

                // Post via axios or other transport method
                fetch('https://api.qrserver.com/v1/read-qr-code/', {
                method: 'POST',
                body: formData,
                })
                .then(function(response) {
                    return response.json();
                }).then(function(myJson) {
                    console.log(myJson);
                })
            });
        };

        qrCanvas.onclick = function() {
            qrVideo.style.display = 'block';
            qrCanvas.style.display = 'none';

            qrStatus.innerHTML = '';
        };

        // $('#click').append('caca<br>');
    </script>
@endpush


