<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Charts;
use App\Models\Sensors;

class ChartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $start_of_month = \Carbon\Carbon::today()->startOfMOnth();
        $end_of_month = \Carbon\Carbon::today()->endOfMonth();

        $data = Sensors::whereDate('dateandtime', '>=', $start_of_month)->whereDate('dateandtime', '<=', $end_of_month)->get();
        $labs1 = [];
        $labs2 = [];
        $labs3 = [];
        $labs4 = [];
        $labs3 = [];
        $labs4 = [];
        $values1 = [];
        $values2 = [];
        $values3 = [];
        $values4 = [];


        foreach ($data as $date){

            if($date->sensor == "Senzor1") {
                $values1[] = "$date->temperature";
                $labs1[] = "$date->dateandtime";

                if($date->humidity > 100){
                    $values3[] = "100";
                    $labs3[] = "$date->dateandtime";
                } else {
                    $values3[] = "$date->humidity";
                    $labs3[] = "$date->dateandtime";
                }

            } else {
                $values2[] = "$date->temperature";
                $labs2[] = "$date->dateandtime";
                if($date->humidity > 100){
                    $values4[] = "100";
                    $labs4[] = "$date->dateandtime";
                } else {
                    $values4[] = "$date->humidity";
                    $labs4[] = "$date->dateandtime";
                }
            }

        }

       $chart =  Charts::multi('areaspline', 'highcharts')
            ->title('The Graph of the last 24 hours')
           ->elementLabel("°C")
            ->yAxisTitle("Graphic Temperature")
            ->colors(['#00b300', '#3385ff'])
            ->labels($labs1, $labs2)
            ->dataset('Sensor 1', $values1)
            ->dataset('Sensor 2',  $values2);

        $chart2 =  Charts::multi('areaspline', 'highcharts')
            ->title('The Graph of the last 24 hours')
            ->elementLabel("%")
            ->yAxisTitle("Graphic Humidity")
            ->colors(['#00b300', '#3385ff'])
            ->labels($labs3, $labs4)
            ->dataset('Sensor 1', $values3)
            ->dataset('Sensor 2',  $values4);

        return view('index', ['chart' => $chart, 'chart2' => $chart2]);
    }

    public function search(){

    }
}
