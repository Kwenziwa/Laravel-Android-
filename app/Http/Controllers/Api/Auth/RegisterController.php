<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
//use Illuminate\Routing\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class RegisterController extends Controller
{
   
    use IssueTokenTrait;
    private $client;



     public function __construct(){
         $this->client = Client::find(1);
     }

    //This is user registration controller 
    public function register(Request $request){



        //// This is a validation in array
        $this->validate($request,[

            'name'=> 'required',
            'email'=> 'required|email|unique:users,email',
            'password'=> 'required|min:6'
        ]);

        // Inserting into db users tables
        $user = User::create([

            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt('password')    
        ]);

        return $this->issueToken($request, 'password');

        //dd($request->all());

    }
}
