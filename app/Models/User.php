<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function getRememberToken()
    {
        return $this->rememberToken;
    }

    public function setRememberToken($value)
    {
        $this->rememberToken = $value;
    }

    public function getRememberTokenName()
    {
        return 'rememberToken';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'rememberToken',
    ];

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\RolesModel','users_roles', 'userId', 'roleId');
    }

    /**
     * check user is admin?
     *
     * @author Quang <quang@gmail.com>
     * 
     * @return boolean [description]
     */
    public function isAdmin()
    {
        if(\Auth::check()) {
            return \Auth::user()->roles()->where('slug','admin')->count();
        } else {
            return false;
        }
    }

    /**
     * create user
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function storeUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user =  $this->create($data);
        return $user;
    }

    /**
     * edit user
     *
     * @author Quang <quangnd.92@gmail.com>
     * 
     * @param [type] $data [description]
     */
    public function updateUser($data)
    {
        $user = $this;
        $user->update($data);
        return $user;
    }

}
