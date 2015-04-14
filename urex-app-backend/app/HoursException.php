<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class HoursException extends Model {
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getOpenAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getCloseAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

}
