<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'state_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $rulesStore = [
        'name'     => 'required|max:255',
        'email'    => 'required|unique:users|max:255|email',
        'password' => 'required|max:255'
    ];

    public $rulesUpdate = [
        'name'     => 'max:255',
        'email'    => 'max:255|email',
        'password' => 'max:255'
    ];

    public function getJWTIdentifier()
    {
      return $this->getKey();
	}

    public function getJWTCustomClaims()
    {
      return [];
    }
}
