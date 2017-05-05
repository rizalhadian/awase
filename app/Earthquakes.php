<?php

namespace awase;

use Illuminate\Database\Eloquent\Model;

class Earthquakes extends Model
{
    protected $table = 'earthquakes';
    protected $primaryKey = 'id';
    protected $fillable = array(
      'id_earthquake_impact',
      'lat',
      'lng',
      'mag',
      'deep',
      'date',
      'tsunami_potential'
    );
}
