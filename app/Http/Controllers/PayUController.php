<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Common;
use DB;

class PayUController extends Controller
{

	public function success_page()
	{
		return view('success_page');

	}

	//For Index Page
	public function surl_request()
	{

		echo 'surl_request';
		$get = $_POST;
		file_put_contents('filename3.txt', print_r($get, true));

		$get = $_GET;
		file_put_contents('filename.txt', print_r($get, true));

		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
			$keyval = explode('=', $keyval);
			if (count($keyval) == 2)
				$myPost[$keyval[0]] = urldecode($keyval[1]);
		}


		file_put_contents('filename2.txt', print_r($myPost, true));
	}

	public function furl_request()
	{

		echo 'surl_request';
		$get = $_POST;
		file_put_contents('filename3.txt', print_r($get, true));

		$get = $_GET;
		file_put_contents('filename.txt', print_r($get, true));

		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
			$keyval = explode('=', $keyval);
			if (count($keyval) == 2)
				$myPost[$keyval[0]] = urldecode($keyval[1]);
		}


		file_put_contents('filename2.txt', print_r($myPost, true));
	}
	public function hash_request()
	{
		echo 'hash_request';

		$get = $_POST;
		file_put_contents('filename3.txt', print_r($get, true));

		$get = $_GET;
		file_put_contents('filename.txt', print_r($get, true));

		$raw_post_data = file_get_contents('php://input');
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
			$keyval = explode('=', $keyval);
			if (count($keyval) == 2)
				$myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		file_put_contents('filename2.txt', print_r($myPost, true));
	}
}