@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">I want to be developer!</h4>
        <small>Be smart and make the world better</small>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container-fluid alert alert-warning text-justify">
        <strong>Attention developers</strong>
        <p>
            You should read this in advance. 
            We are very happy with external people developing for our platform 
            but we would like to keep this safe for everyone. 
            Think that we are developing systems that are into customers' house.
            For that, we control some aspects around our services. Some of them 
            are written in the list below. Detecting anyone breaking the contract 
            means the revokation of permissions and cancelation of the account so, 
            please, read the entire contract. Although we are not responsible for 
            the use the users do of our services, we will do everything in our power 
            to make everyone respects the terms os service.
        </p>

        <strong>
            List of some rules <a href="#" class="text-muted">(TOS and privacy policy)</a>
        </strong>
        <ul>
            <li>No illegal content (no pedo, no killing, no abuse, no other illegal content)</li>
            <li>
                Our services are made for everyone so control yourself and make a good job when developing. 
                We have filters to avoid flood or spam in our services but we ask you to be polite and make the things right. 
            </li>
            <li>
                Remember thar user data are not yours so treat data carefully and remember that we store them, not you. This 
                means we are a user-first company and the user will always be informed about who is accessing its data and how. 
            </li>
            <li>
                There is a form where users can report apps in our services. If some user report an application, 
                depending on the reason of the report we could revoke permissions for that app temporary or even forever.
                Each report will be reviewed handly. In the other hand, there is another form where developers can complain 
                or ask us to review the case and activate the account again if the report was unfair.
            </li>

        </ul>
    </div>

    <ul class="list-group">
        <li class="list-group-item py-4">
            <div class="d-flex flex-column mb-3 flex-grow-1">
                <form action="{{ url('developers/apply') }}" method="post">
                    @csrf
                    <div class="form-group">

                        <div class="mt-3 mb-3">
                            <span class="my-5 h5">
                                Entity
                            </span>
                            <p class="small">
                                Who is going to develop
                            </p>
                        </div>

                        <div class="pt-4 pb-2">
                            <label for="TheName" class="font-weight-bold">Name</label>
                            <input name="name" type="text" class="form-control" id="TheName" placeholder="Your name / Your business name" required>
                        </div>

                        <div class="pt-4 pb-4">
                            <label for="TheID" class="font-weight-bold">Document ID</label>
                            <input name="document" type="text" class="form-control" id="TheID" placeholder="Your ID / Your business ID" required>
                        </div>

                        <div class="mt-5">
                            <span class="my-5 h5">
                                Contact
                            </span>
                            <p class="small">
                                How to contact the developers
                            </p>
                        </div>

                        <div class="pt-4 pb-2">
                            <label for="TheEmail" class="font-weight-bold">Email</label>
                            <input name="email" type="text" class="form-control" id="TheEmail" placeholder="How to contact your team" required>
                        </div>

                        <div class="pt-4 pb-4">
                            <label for="ThePhone" class="font-weight-bold">Phone number</label>
                            <input name="phone" type="text" class="form-control" id="ThePhone" placeholder="How to contact your team" required>
                            <small class="text-muted">International format, like: +00555555</small>
                        </div>

                        <div class="mt-5">
                            <span class="my-5 h5">
                                Extra
                            </span>
                            <p class="small">
                                Some data we like to read
                            </p>
                        </div>

                        <div class="pt-4 pb-4">
                            <label for="TheSummary" class="font-weight-bold">Summary</label>
                            <textarea class="form-control" name="summary" id="TheSummary" placeholder="What kind of apps you want to develop" required></textarea>
                        </div>

                        


                    </div>
                    <button type="submit" class="btn btn-secondary" onclick="return confirm('Are you sure you accept our TOS and Privacy Policy?');">Send my request</button>
                    <small class="form-text text-muted">Clicking the button means you accept our TOS and Privacy Policy</small>
                </form>
            </div>
        </li>
        
    </ul>

@endsection
