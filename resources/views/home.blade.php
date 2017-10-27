@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! A client is required to use API
                        <a href="client" type="button" class="btn btn-success">Create</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! Authorize Spotify is required to use API
                    <a href="https://accounts.spotify.com/authorize/?scope=user-read-private%20user-read-email&response_type=code&client_id=82437470a7284dc0a874d34cf8df38c3&redirect_uri=http%3A%2F%2Fsearchsongsapi.dev%2Fapi%2Fcallback&state=34fFs29kd09" type="button" class="btn btn-success">Authorize</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
