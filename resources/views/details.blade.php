@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Details</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        @foreach ($users as $user)
                            <li class="list-group-item">
                                {{ $user->login_time }} 
                                <img src="{{ $user->picture }}" alt="" referrerpolicy="no-referrer" style="border-radius: 50%!important;" width="24" height="24"> 
                                {{ $user->name }} 
                                ({{ $user->family_name }}, {{ $user->given_name }})
                                <a href="mailto:{{ $user->email }}">{{ $user->email }}</a> 
                                <i class="flag flag-{{ country_code($user->locale) }}"></i>
                                {{ $user->hd }} 
                                {{ $user->locale }} 
                                {{ $user->google_id }} 
                                @if($user->verified_email)
                                    <span style="width: 24px;height: 24px;background-color: #7cb342;font-weight: bolder;color: white;">&#10003;</span>
                                @else
                                    <span style="width: 24px;height: 24px;font-weight: bolder;">&#10060;</span>
                                @endif
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
