<?php

namespace awase\Http\Controllers;


use Illuminate\Http\Request;
use App\Privilages;

class TestController extends Controller
{
    public function index(){
      $privilages = \awase\Privilages::all();

      foreach ($privilages as $privilage) {
        echo $privilage->name;
      }
    }
}
