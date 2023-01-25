<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Input;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller {
	
	
	
	/*Login API*/ 
	public function test(Request $request){
		
		/*$name=$_POST['name'];
		$email=$_POST['email'];
		
		$result=array();
		
		if(!empty($name)){
			$result = array(
				'statusCode'	=> '200',
				'data'			=> $_POST,
				'message'		=> '',
			);
		}else{
			$result = array(
				'statusCode'	=> '404',
				'error'			=> 'error',
				'message'		=> 'error',
			);
		}*/
		
		return response()->json(['name' => 'Abigail', 'state' => 'CA']);
	}
	
	
}
