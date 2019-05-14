<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getWeather()
    {
        // Get city from user IP
        $geoLocation = geoip(request()->ip());
        $city = $geoLocation['city'];
    
        // Get weather
        $appID = 'c654b7fb315699763f29e70a454a92ce';
        $url = "api.openweathermap.org/data/2.5/weather?q={$city}&APPID={$appID}";

        $client = new \GuzzleHttp\Client();
        $res = $client->get($url);

        if ($res->getStatusCode() == 200) {
            $j = $res->getBody();
            $obj = json_decode($j);
            
            return response()->json([
                'city' => $city,
                'weather' => $obj->weather[0],
            ]);
        }
    }
}
