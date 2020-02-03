@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Developer application confirmation') }}</h4>
        <small>{{ __('Be smart and make the world better') }}</small>
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
            {{ __('Before accepting, be sure what you are doing.') }}
        </p>

        <strong>{{ __('User profile') }}</strong>

        <ul>
            <li>
                <strong>{{ __('Created') }}:</strong> {{ $profile['user']->created_at }}
            </li>
            <li>
                <strong>{{ __('Name') }}:</strong> {{ $profile['user']->name }}
            </li>
            <li>
                <strong>{{ __('Email') }}:</strong> {{ $profile['user']->email }}
            </li>
            <li>
                <strong>{{ __('Verified') }}:</strong> 
                @if ( is_null ($profile['developer']->email_verified_at) )
                    <span class="text-info">{{ __('Not verified') }}</span>
                @else
                    {{ __('Verified') }}
                @endif
            </li>
            
        </ul>
        

        <strong>{{ __('Developer profile') }}</strong>
        <ul>
            <li>
                <strong>{{ __('Sent') }}:</strong> {{ $profile['developer']->created_at }}
            </li>
            <li>
                <strong>{{ __('Name') }}:</strong> {{ $profile['developer']->name }}
            </li>
            <li>
                <strong>{{ __('Document') }}:</strong> {{ $profile['developer']->document }}
            </li>
            <li>
                <strong>{{ __('Email') }}:</strong> {{ $profile['developer']->email }}
            </li>
            <li>
                <strong>{{ __('Phone') }}:</strong> {{ $profile['developer']->phone }}
            </li>
            <li>
                <strong>{{ __('Summary') }}:</strong> {{ $profile['developer']->summary }}
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
                                    {{ __('Accept or decline this application?') }}
                                </span>
                            </div>

                            <div class="pt-4 pb-4">
                                <label class="font-weight-bold">{{ __('Message') }}</label>
                                <textarea maxlength="500" class="form-control" name="message" placeholder="{{ __('Message for the developer') }}"></textarea>
                            </div>
                            
                        </div>

                        {{-- Button only appears on verified users --}}
                        @if ( !is_null ($profile['developer']->email_verified_at) )
                            <button type="submit" name="accept" class="btn btn-primary" onclick="return confirm(' {{ __("Are you sure you accept this application?") }} ');" >
                                {{ __('Accept') }}
                            </button>
                        @endif
                        

                        <button type="submit" name="decline" class="btn btn-primary" onclick="return confirm(' {{ __("Are you sure you reject this application?") }}');">
                            {{ __('Decline') }}
                        </button>

                    </form>
                @else
                    {{ __('This user has already been accepted as developer') }}
                @endif
            </div>
        </li>
        
    </ul>
    

@endsection
