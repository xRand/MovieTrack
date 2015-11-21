<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


   //Films that belong to the user
    public function films()
    {
        return $this->belongsToMany('App\Film', 'subscription')->withTimestamps();
    }

    //Comments that belong to the user
//    public function comments()
//    {
//        return $this->belongsToMany('App\Film', 'comments');
//    }

    //find user by id
    public function scopeFindById($query, $id)
    {
        $user = $query->where('id', '=', $id)->first();
        if (is_null($user)) {
            abort(404);
        }
        return $user;
    }

    //temporary
    public function isAnAdmin()
    {
        if(Auth::user()->name == 'admin') return true;
        else return false;
    }
}
