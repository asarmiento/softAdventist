<?php

namespace App\Entities;

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
        'name','last_name','identification_card', 'email', 'password','type_user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function youngBoy()
    {
        return $this->hasOne(YoungBoy::getClass());
    }

    public function countYoungBoy()
    {
        return $this->hasOne(YoungBoy::getClass())->count();
    }

    public function nameComplete()
    {
        return $this->name.' '.$this->last_name;
    }
}
