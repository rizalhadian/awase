<?php

namespace awase;

use Illuminate\Database\Eloquent\Model;

class HelpRequests extends Model
{
    protected $table = 'help_requests';
    protected $primaryKey = 'id';
    protected $fillable = array(
      'id_account',
      'id_help_status',
      'lat',
      'lng',
      'message'
    );
}
