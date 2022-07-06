<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin', [
            'users' => DB::table('users')
            ->select(DB::raw('count(*) as login_count, users.*, logins.login_time'))
            ->leftJoin('logins', 'users.id', '=', 'logins.user_id')
            ->orderBy('logins.login_time', 'desc')
            ->groupBy('logins.user_id')
            ->paginate(10)
        ]);
    }

    /**
     * Show user login details.
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        return view('details', [
            'users' => DB::table('users')
            ->leftJoin('logins', 'users.id', '=', 'logins.user_id')
            ->orderBy('logins.login_time', 'desc')
            ->paginate(10)
        ]);
    }
}
