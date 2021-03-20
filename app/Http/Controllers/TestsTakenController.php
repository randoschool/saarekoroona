<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestsTakenController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $response = Http::get('https://opendata.digilugu.ee/opendata_covid19_test_county_all.json')->collect();

        $data = $response->where('CountyEHAK', '0074')
                        ->sortBy('StatisticsDate')
                        ->map(function($item){
                            return [
                                'StatisticsDate' => Carbon::parse($item['StatisticsDate']),
                                'ResultValue' => $item['ResultValue'],
                                'DailyCases' => $item['DailyCases'],
                                'DailyTests' => $item['DailyTests']
                            ];
                        })
                        ->filter(function($item){
                            return $item['StatisticsDate']->greaterThan(Carbon::now()->subMonths(3));
                        })
                        ->map(function($item){
                            return [
                                'StatisticsDate' => $item['StatisticsDate']->format('d. M Y'),
                                'ResultValue' => $item['ResultValue'],
                                'DailyCases' => $item['DailyCases'],
                                'DailyTests' => $item['DailyTests']
                            ];
                        })
                        ->values()
                        ;

        return view('welcome', compact('data'));
        }
    }
