<?php

namespace awase;

use Illuminate\Database\Eloquent\Model;

class DisasterStatus extends Model
{
  protected $table = 'disaster_status';
  protected $primaryKey = 'id';
  protected $fillable = array(
    'name'
  );
}
