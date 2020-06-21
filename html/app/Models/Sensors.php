<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class Sensors extends Model

{
    protected $dates = ['dateandtime'];
    protected $table = 'temperaturedata';
    protected $fillable = ['id', 'dateandtime', 'sensor', 'temperature', 'humidity'];

}
