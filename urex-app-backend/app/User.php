<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category() {
        return $this->belongsTo('Category');
    }
    
}
