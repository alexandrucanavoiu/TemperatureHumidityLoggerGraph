<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Charts;
use App\Models\Sensors;
use Form;

class HomeController extends Controller
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
        $user = \Auth::user();

        $data = Sensors::where('dateandtime', '>', \Carbon\Carbon::now()->subDay())->get();
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
            ->title('The Graph for the last 24 hours - Temperature')
            ->elementLabel("°C")
            ->yAxisTitle("Graphic Temperature")
            ->colors(['#00b300', '#3385ff'])
            ->labels($labs1, $labs2)
            ->dataset('Sensor 1', $values1)
            ->dataset('Sensor 2',  $values2);

        $chart2 =  Charts::multi('areaspline', 'highcharts')
            ->title('The Graph for the last 24 hours - Humidity')
            ->elementLabel("%")
            ->yAxisTitle("Graphic Humidity")
            ->colors(['#00b300', '#3385ff'])
            ->labels($labs3, $labs4)
            ->dataset('Sensor 1', $values3)
            ->dataset('Sensor 2',  $values4);


        $sensor1 = Sensors::where('sensor', 'Senzor1')->orderBy('id', 'desc')->first();
        $sensor2 = Sensors::where('sensor', 'Senzor2')->orderBy('id', 'desc')->first();

        return view('home', ['user' => $user, 'chart' => $chart, 'chart2' => $chart2, 'sensor1' => $sensor1, 'sensor2' => $sensor2]);
    }

    public function search(){
        $user = \Auth::user();
        $curent_date = \Carbon\Carbon::now()->format('Y-m-d');
        $curent_date_minus_a_week = \Carbon\Carbon::now()->subDays(7)->format('Y-m-d');

        $data = Sensors::where('dateandtime', '>', \Carbon\Carbon::now()->subWeek())->get();
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
            ->title('The Graph for the last week - Temperature')
            ->elementLabel("°C")
            ->yAxisTitle("Graphic Temperature")
            ->colors(['#00b300', '#3385ff'])
            ->labels($labs1, $labs2)
            ->dataset('Sensor 1', $values1)
            ->dataset('Sensor 2',  $values2);

        $chart2 =  Charts::multi('areaspline', 'highcharts')
            ->title('The Graph for the last week - Humidity')
            ->elementLabel("%")
            ->yAxisTitle("Graphic Humidity")
            ->colors(['#00b300', '#3385ff'])
            ->labels($labs3, $labs4)
            ->dataset('Sensor 1', $values3)
            ->dataset('Sensor 2',  $values4);


        return view('search', ['user' => $user, 'chart' => $chart, 'chart2' => $chart2, 'curent_date' => $curent_date, 'curent_date_minus_a_week' => $curent_date_minus_a_week]);
    }

    public function search_post(Request $request){
        $user = \Auth::user();

        $this->validate($request, [
            'start' => 'required|date_format:Y-m-d',
            'end' => 'required|date_format:Y-m-d',
        ]);

        $start_input = $request->input('start');
        $end_input = $request->input('end');
        $start = $request->input('start') . " 00:00:00";
        $end = $request->input('end') . " 23:59:59";

        $data = Sensors::whereDate('dateandtime', '>=', $start)->whereDate('dateandtime', '<=', $end)->get();

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
            ->title('The Graph for Temperature - ' . $start . ' - ' . $end)
            ->elementLabel("°C")
            ->yAxisTitle("Graphic Temperature")
            ->colors(['#00b300', '#3385ff'])
            ->labels($labs1, $labs2)
            ->dataset('Sensor 1', $values1)
            ->dataset('Sensor 2',  $values2);

        $chart2 =  Charts::multi('areaspline', 'highcharts')
            ->title('The Graph for Humidity - ' . $start . ' - ' . $end)
            ->elementLabel("%")
            ->yAxisTitle("Graphic Humidity")
            ->colors(['#00b300', '#3385ff'])
            ->labels($labs3, $labs4)
            ->dataset('Sensor 1', $values3)
            ->dataset('Sensor 2',  $values4);


        return view('search_post', ['user' => $user, 'chart' => $chart, 'chart2' => $chart2, 'start_input' => $start_input, 'end_input' => $end_input]);

    }
}
