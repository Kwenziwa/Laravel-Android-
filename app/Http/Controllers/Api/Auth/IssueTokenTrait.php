<?php 

namespace App\Http\Controllers\Api\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


trait IssueTokenTrait{



    public function issueToken(Request $request, $grantType, $scope = ""){
		$params = [
    		'grant_type' => $grantType,
    		'client_id' => '2',
            'client_secret'=> '9Ho9AAHp9QJ8iPOCsvbPTBAZiI7ifYiQyDYxWjZ7',    		
    		'scope' => $scope
    	];
        if($grantType !== 'social'){
            $params['username'] = $request->username ?: $request->email;
        }
    	$request->request->add($params);
    	$proxy = Request::create('oauth/token', 'POST');
    	return Route::dispatch($proxy);
	}
}