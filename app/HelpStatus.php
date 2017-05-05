<?php

namespace awase;

use Illuminate\Database\Eloquent\Model;

class HelpStatus extends Model
{
    protected $table = 'help_status';
    protected $primaryKey = 'id';
    protected $fillable = array(
      'name'
    );
}
