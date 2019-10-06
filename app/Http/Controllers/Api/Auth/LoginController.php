<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;



class LoginController extends Controller
{

    use IssueTokenTrait; 
    private $client;

    public function __construct(){
        $this->client = Client::find(1);
    }
    
    //This Function is for login
    public function login(Request $request){

        
        //// This is a validation in array
        $this->validate($request,[
            'username'=> 'required',
            'password'=> 'required'
        ]);

        return $this->issueToken($request, 'password',  $scope="*");

        

    }

    //This Function is for refrshing token
    public function refresh(Request $request){

       //// This is a validation in array
       $this->validate($request,[
        'refresh_token'=> 'required'
        
         ]);

         return $this->issueToken($request, 'refresh_token');

        
    }

     //This Function is for logout
    public function logout(Request $request){

        $accessToken = Auth::user()->token();
        $refreshToken = DB::table('oauth_refresh_tokens')
        ->where('access_token_id',$accessToken->id)
        ->update(['revoked' =>true]);
        $accessToken->revoke();

        return response()->json([],204);

        
    }


}
