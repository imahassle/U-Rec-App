<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function images() {
        return $this->belongsToMany('Image');
    }

    public function getStartAttribute($value)
    {
        return date("m/d/Y h:i A", strtotime($value));
    }

    public function getEndAttribute($value)
    {
        return date("m/d/Y h:i A", strtotime($value));
    }

}
