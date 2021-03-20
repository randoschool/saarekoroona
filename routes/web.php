<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $response = Http::get('https://opendata.digilugu.ee/opendata_covid19_test_county_all.json')->collect();

    $data = $response->where('CountyEHAK', '0074')
                    ->sortBy('StatisticsDate')
                    ->map(function($item){
                        return [
                            'StatisticsDate' => Carbon\Carbon::parse($item['StatisticsDate'])->format('d.m.Y'),
                            'ResultValue' => $item['ResultValue'],
                            'DailyCases' => $item['DailyCases'],
                            'DailyTests' => $item['DailyTests']
                        ];
                    })
                    ->values()
                    ;

    return view('welcome', compact('data'));
});
