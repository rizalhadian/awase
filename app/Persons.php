<?php

namespace awase;

use Illuminate\Database\Eloquent\Model;

class Persons extends Model
{
    protected $table = 'persons';
    protected $primaryKey = 'id';
    protected $fillable = array(
      'name',
      'address',
      'phone',
      'email',
      'gender'
    );
}
