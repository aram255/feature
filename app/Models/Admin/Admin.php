<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin';
    protected $guard = 'admin';
    protected $guarded = array('admin');

    protected $fillable = [
        'username', 'password',
    ];
}