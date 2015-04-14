<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $table = 'feedback';

    public function getDateAttribute($value)
    {
        return date("m/d/Y h:i A", strtotime($value));
    }
    
}
