<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;

class Announcement extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function getDateAttribute($value)
    {
        return date("m/d/Y", strtotime($value));
    }

    public static function find($id, $columns = array('*'))
    {
        $announcement = parent::find($id, $columns);

        if(is_null($announcement)) {
            throw new ClientException("Announcement not found.");
        }

        return $announcement;
    }

    public static function create(array $attributes) 
    {
        $user = ApiKey::whereKey($attributes['X-Authorization'])->first()->user;

        $announcement = new Announcement;
        $announcement->message = $attributes['message'];
        $announcement->date = date("Y-m-d h:i:s", strtotime($attributes['date']));
        $announcement->user_id = $user->id;

        if(array_key_exists('category_id', $attributes)) {
            $announcement->category_id = $attributes['category_id'];
        } else {
            $announcement->category_id = $user->category->id;
        }

        if(!$announcement->save()) {
            throw new ServerException("Announcement was not created successfully due to an internal server error.");
        }

        return $announcement;
    }

    public function update(array $attributes = array())
    {
        $user = ApiKey::whereKey($attributes['X-Authorization'])->first()->user;

        $this->message = $attributes['message'];
        $this->date = date("Y-m-d h:i:s", strtotime($attributes['date']));
        $this->user_id = $user->id;

        if(array_key_exists('category_id', $attributes)) {
            $this->category_id = $attributes['category_id'];
        } else {
            $this->category_id = $user->category->id;
        }

        if(!$this->save()) {
            throw new ServerException("Announcement was not updated successfully due to an internal server error.");
        }
    }

    public function delete() 
    {
        if(!parent::delete()) {
            throw new ServerException("Announcement was not deleted successfully due to an internal server error.");
        }
    }
    
}
