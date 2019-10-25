@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">Create new app</h4>
        <small>Be strong and make the world better</small>
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

    <div class="container-fluid alert alert-warning">
        <strong>Brief summary of our developing rules</strong>
        <p>
            Hello mr/mrs developer, you should read this in advance. 
            We are very happy with external people developing into our platform 
            but we would like to keep this safe for everyone. For that, we control 
            some aspects around our services. Some of them (the most important ones) 
            are written in the list below. Detecting anyone breaking the contract 
            means the revokation of permissions and cancelation of the account so, 
            please, read the entire contract. Moreover, we are not responsible for 
            the use you do of our services.
            <strong>
                <a href="#" class="text-muted"> in this link </a>
            </strong>
        </p>
        <strong>List of some rules (not all)</strong>
        <ul>
            <li>No illegal content (no pedo, no killing, no abuse, no other illegal content)</li>
            <li>
                Our services are made for everyone so control yourself and make a good job when developing. 
                We have filters to avoid flood or spam in our services but we ask you to be polite and make the things right. 
            </li>
            <li>
                Remember thar user data are not yours so treat data carefully and remember that we store them, not you. This 
                means we are user-first and the user will always know who is accessing its data and how. 
            </li>
            <li>
                There is a form where users can report apps in our services. If some user report an application, 
                depending on the reason of the report we could revoke permissions for that app temporary or even forever.
                Each report will be reviewed handly. In the other hand, there is another form where developers (you) can complain 
                or ask us to activate the account again if you consider the report unfair.
            </li>

        </ul>
    </div>

    <ul class="list-group">
        <li class="list-group-item py-4">
            <div class="d-flex flex-column mb-3 flex-grow-1">
                <form action="/developers/clients/create" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="pt-4 pb-4">
                            <label for="TheName" class="font-weight-bold">Name</label>
                            <input name="name" type="text" class="form-control" id="TheName" placeholder="Fancy name for your app" required>
                        </div>

                        <div class="pb-4">
                            <label for="TheRedirect" class="font-weight-bold">Destination URI</label>
                            <input name="redirect" type="text" class="form-control" id="TheRedirect" placeholder="http://valid.url/gimme/data" required>
                            <small class="form-text text-muted">A valid URI where we will send some data</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure?');">Create my new app!</button>
                    <small class="form-text text-muted">Clicking the button means you accept our terms and conditions</small>
                </form>
            </div>
        </li>
        
    </ul>

@endsection
