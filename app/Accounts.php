<?php

namespace awase;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Accounts extends Authenticatable
{
    use Notifiable;
    protected $table = "accounts";
    protected $primaryKey = "id";
    protected $fillable = array(
      'id_privilage',
      'id_person',
      'username',
      'email',
      'password',
      'remember_token',
    );

    protected $hidden = [
        'password', 'remember_token',
    ];
}
