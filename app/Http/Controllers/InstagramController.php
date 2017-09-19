<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InstagramController extends Controller
{
     /**
     * Get the index name for the model.
     *
     * @return string
    */
    public function index(Request $request)
    {
    	$items = [];

    	if($request->has('username')){

	 	$client = new \GuzzleHttp\Client;
	 	$url = sprintf('https://www.instagram.com/%s/media', $request->input('username'));
        $response = $client->get($url);
        $items = json_decode((string) $response->getBody(), true)['items'];

    	}

    	return view('sns.instagram',compact('items'));
    }


    public function displayByHashtag($hashtag)
    {
    	$items = [];

    	$client = new \GuzzleHttp\Client;
	 	$url = sprintf('https://api.instagram.com/v1/tags/'.$hashtag.'/media/recent?access_token=6044746535.244bcdc.5dc53eca9f6e4173a0f5ee1bdb349e97');

        $response = $client->get($url);
        $items = json_decode((string) $response->getBody(), true);

        return view('sns.instagram',compact('items'));
    }
}
