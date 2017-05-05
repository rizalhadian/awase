<?php

namespace awase;

use Illuminate\Database\Eloquent\Model;

class Disasters extends Model
{
    protected $table = 'disasters';
    protected $primaryKey = 'id';
    protected $fillable = array(
      'id_earthquake',
      'id_account',
      'name',
      'lat',
      'lng'
    );
}
