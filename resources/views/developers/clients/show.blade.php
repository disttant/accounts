@extends('layouts.panel')

@section('contentt')

    <div class="mb-5">
        <h4 class="my-1">Developers</h4>
        <small>I'm a god and want to build an app</small>
    </div>

    <div class="my-4">
        <a href="/developers/clients/create" class="btn btn-info" onclick="return confirm('Sure you want to make an app?');">
            I want to make an app!
        </a>

        <a href="/developers/clients/restore" class="btn btn-secondary">
            <i class="material-icons align-middle">report</i>
            Restore my app
        </a>
    </div>

    <ul class="list-group">

        @if ( count($clients) === 0 )
            <div class="alert alert-warning">
                No clients have been created by the moment. 
                If you would like to create an app, 
                click in the botton and start the process.
            </div>
        @endif


        @foreach ($clients as $client)

            <a href="#" class="list-group-item list-group-item-action">
                <div class="d-flex p-2 align-items-stretch">
                    <div class="d-flex flex-grow-1 justify-content-between align-items-center">
                        <div class="d-flex flex-column mb-3 flex-grow-1 ">
                            <div class="my-2">
                                <div class="font-weight-bold">Application name</div>
                                <div>{{$client['name']}}</div>
                            </div>

                            <div class="my-2">
                                <div class="font-weight-bold">Data destination</div>
                                <div>{{$client['redirect']}}</div>
                            </div>

                            <div class="my-2">
                                <div class="font-weight-bold">
                                    Credentials
                                    @if ( $client['revoked'] === false )
                                        <span class="badge badge-pill badge-success">Active</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Revoked</span>
                                    @endif
                                </div>
                                <div>ID: {{$client['id']}}</div>
                                <div>Secret: {{$client['secret']}}</div>
                            </div>

                            <div class="mt-2">
                                <div>
                                    <small class="font-weight-bold">Creation</small>
                                </div>
                                <div><small>{{$client['created_at']}}</small></div>
                            </div>

                            <div class="mt-5">
                                <form action="/developers/clients/delete" method="POST">
                                    @csrf
                                    <!--@method('DELETE')-->
                                    <input type="hidden" name="id" value="{{$client['id']}}">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Sure you want to delete this app?');">
                                        <i class="material-icons">delete_forever</i>
                                    </button>
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                    <!--
                        <div class="d-flex justify-content-between align-items-center">
                            <i class="material-icons align-middle">keyboard_arrow_right</i>
                        </div>
                    -->
                </div>
            </a>

        @endforeach

    </ul>

@endsection
