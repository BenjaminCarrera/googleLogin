@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Details</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-sm-6 col-md-4">
                                    <img src="{{ Auth::user()->picture }}" alt="" referrerpolicy="no-referrer" class="img-rounded img-responsive">
                                </div>
                                <div class="col-sm-6 col-md-8">
                                    <h4>{{ Auth::user()->name }}</h4>
                                    <p>
                                        {{ Auth::user()->email }}
                                        <br>
                                        Verified Email: 
                                            @if (Auth::user()->verified_email) 
                                                True
                                            @else 
                                              False
                                            @endif
                                        <br>
                                        Family Name: {{ Auth::user()->family_name }}
                                        <br>
                                        Given Name: {{ Auth::user()->given_name }}
                                        <br>
                                        Domain: {{ Auth::user()->hd }}
                                        <br>
                                        Locale: {{ Auth::user()->locale }}
                                        <br>
                                        Google Id: {{ Auth::user()->google_id }}
                                        <br>
                                        Number of Logins: {{ session()->get('loginCount') }}
                                        <br>
                                        @if(@Auth::user()->hasRole('admin'))
                                            <a href="{{ url('/admin') }}">Admin</a>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
