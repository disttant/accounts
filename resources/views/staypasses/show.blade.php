@extends('layouts.panel')

@section('content')

    <div class="mb-5">
        <h4 class="my-1">{{ __('Staypasses') }}</h4>
        <small>{{ __('Accomodation customer? welcome to your paradise')}}</small>
    </div>

    <div class="my-4">
        <a href="{{ url('staypasses/create') }}" class="btn btn-primary">
            {{ __('Create a Staypass') }}
        </a>
    </div>

    @if ( count($staypassList['staypasses']) === 0 )

        <div class="my-4">
            <div class="alert alert-light" role="alert">
                {{ __('No Staypasses added yet. Add one to start the magic.') }}
            </div>
        </div>

    @else

        <ul class="list-group">
            @foreach ( $staypassList['staypasses'] as $staypass )
                <div class="list-group-item list-group-item-action">
                    <div class="d-flex p-2 align-items-stretch">
                        <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                            <div class="d-flex flex-column mb-3 flex-grow-1 ">

                                <div class="my-2">
                                    <div class="font-weight-bold">{{ __('Staypass name') }}</div>
                                    <div>{{ $Staypass['name'] }}</div>
                                </div>

                                <div class="d-flex flex-row mt-3">

                                    <!-- Actions menu -->
                                    <div class="dropdown mr-2">
                                        <button type="button" class="btn btn-primary" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ __('Actions') }}
                                            <i class="material-icons md-18 align-middle">arrow_drop_down</i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            
                                            <div class="dropdown-item p-0">
                                                <form action="{{ url('staypasses/change/default') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $staypass['id'] }}">
                                                    <input type="hidden" name="key" value="true">
                                                    <button type="submit" class="px-4 py-3 m-0 bg-transparent border-0 w-100 text-left align-middle " onclick="return confirm('{{ __("Sure you want to change the key?") }}');">
                                                        {{ __('Default') }}
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="dropdown-divider"></div>

                                            <div class="dropdown-item p-0">
                                                <form action="{{ url('staypasses/remove') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $staypass['id'] }}">
                                                    <button type="submit" class="px-4 py-3 m-0 bg-transparent border-0 w-100 text-left align-middle" onclick="return confirm('{{ __("Sure you want to delete this node?") }}');">
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- / Actions menu -->
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </ul>

    @endif

@endsection
