<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;

class Feedback extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $table = 'feedback';

    public function getDateAttribute($value)
    {
        return date("M d, Y h:ia", strtotime($value));
    }

    public static function find($id, $columns = array('*'))
    {
        $feedback = parent::find($id, $columns);

        if(is_null($feedback)) {
            throw new ClientException("Feedback not found.");
        }

        return $feedback;
    }

    public static function create(array $attributes) 
    {
        $feedback = new Feedback;
        $feedback->message = $attributes['message'];
        $feedback->email = $attributes['email'];
        $feedback->date = date("Y-m-d H:i:s", strtotime($attributes['date']));

        if(!$feedback->save()) {
            throw new ServerException("Feedback was not created successfully due to an internal server error.");
        }

        return $feedback;
    }

    public function delete()
    {
        if(!parent::delete()) {
            throw new ServerException("Feedback was not deleted successfully due to an internal server error.");
        }
    }
    
}