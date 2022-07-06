<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'family_name', 'name', 'picture', 'locale', 'email', 'given_name', 'google_id', 'hd', 'verified_email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the user id
     *
     * @return user_id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get logins
     *
     * @return logins
     */
    public function logins()
    {
        return $this->hasMany("App\Login", "user_id", "id");
    }

}
