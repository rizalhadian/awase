<?php

namespace awase;

use Illuminate\Database\Eloquent\Model;

class EarthquakeImpact extends Model
{
    protected $table = 'earthquake_impact';
    protected $primaryKey = 'id';
    protected $fillable = array(
      'generated_id',
      'mag_min',
      'mag_max',
      'deep_min',
      'deep_max',
      'impact_area'
    );
}
