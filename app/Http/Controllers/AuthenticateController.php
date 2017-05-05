<?php

namespace awase\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use Hash;

class AuthenticateController extends Controller
{
  public function index(){

  }

  public function auth(Request $request){
    $tes = bcrypt("rahasia");

    echo $tes;
    // return $count;
  }

  public function count(Request $request){
    $dataPosted = $request->all();
    $hashpass = Hash::make($dataPosted['password']);
    $count = \awase\Account::where('email', $dataPosted['email'])
        ->where('password', $hashpass)
        ->count();

    // echo json_encode($count);
    return $count;
  }
}
