@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">Developer application confirmation</h4>
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

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="container-fluid alert alert-warning text-justify">
        <p>
            Before accepting, be sure what you are doing. The user must have verified its account
            and must NOT have fake data in the personal account.
        </p>

        <strong>User Profile</strong>

        <ul>
            <li>
                <strong>Created:</strong> {{ $profile['user']->created_at }}
            </li>
            <li>
                <strong>Name:</strong> {{ $profile['user']->name }}
            </li>
            <li>
                <strong>Email:</strong> {{ $profile['user']->email }}
            </li>
            <li>
                <strong>Email verified:</strong> 
                @if ( is_null ($profile['developer']->email_verified_at) )
                    Not verified
                @else
                    Verified
                @endif
            </li>
            
        </ul>
        

        <strong>Developer Profile</strong>
        <ul>
            <li>
                <strong>Sent:</strong> {{ $profile['developer']->created_at }}
            </li>
            <li>
                <strong>Name:</strong> {{ $profile['developer']->name }}
            </li>
            <li>
                <strong>Document:</strong> {{ $profile['developer']->document }}
            </li>
            <li>
                <strong>Email:</strong> {{ $profile['developer']->email }}
            </li>
            <li>
                <strong>Phone:</strong> {{ $profile['developer']->phone }}
            </li>
            <li>
                <strong>Summary:</strong> {{ $profile['developer']->summary }}
            </li>
            
        </ul>
    </div>

    

    <ul class="list-group">
        <li class="list-group-item py-4">
            <div class="d-flex flex-column mb-3 flex-grow-1">
            
                @if ( $profile['user']->hasRole('developer') == false )
                    <form method="post">
                        @csrf
                        <div class="form-group">

                            <div class="mt-3 mb-3">
                                <span class="my-5 h5">
                                    Accept or decline this application?
                                </span>
                            </div>

                            <div class="pt-4 pb-4">
                                <label class="font-weight-bold">Message</label>
                                <textarea maxlength="500" class="form-control" name="message" placeholder="Message for the developer"></textarea>
                            </div>
                            
                        </div>

                        <button type="submit" name="accept" class="btn btn-primary" onclick="return confirm('Are you sure you accept this application?');" >
                            <!-- @if ( is_null ($profile['developer']->email_verified_at) ) disabled @endif-->
                            Accept
                        </button>

                        <button type="submit" name="decline" class="btn btn-primary" onclick="return confirm('Are you sure you reject this application?');">Decline</button>

                    </form>
                @else
                    This user has already been verified as developer
                @endif
            </div>
        </li>
        
    </ul>
    

@endsection
