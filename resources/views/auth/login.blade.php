@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login (you need a google email to access)</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="GET" action="{{ route('redirect') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                @if($errors->any())
                                    <span class="help-block">
                                        <strong>{{ $errors->first() }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
