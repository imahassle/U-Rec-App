<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class HoursException extends Model {
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
