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

                    <ul class="list-group">
                        @foreach ($users as $user)
                            <li class="list-group-item">
                                [{{ $user->login_count }}] 
                                <img src="{{ $user->picture }}" alt="" referrerpolicy="no-referrer" style="border-radius: 50%!important;" width="24" height="24"> 
                                {{ $user->name }} 
                                (<a href="mailto:{{ $user->email }}">{{ $user->email }}</a>) 
                                {{ $user->login_time }} 
                            </li>
                        @endforeach
                    </ul>

                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
