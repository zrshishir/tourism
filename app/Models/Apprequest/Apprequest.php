<?php

namespace App\Models\Apprequest;

use Illuminate\Database\Eloquent\Model;

class Apprequest extends Model
{
    protected $table = 'apprequests';
    protected $fillable = ['user_id', 'request', 'status'];
}
