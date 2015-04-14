<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getDateAttribute($value)
    {
        return date("m/d/Y", strtotime($value));
    }
    
}
