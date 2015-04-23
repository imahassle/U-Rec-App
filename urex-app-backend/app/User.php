<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Exceptions\AuthException;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;
use Hash;

class User extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['password', 'created_at', 'updated_at'];

    public function category() 
    {
        return $this->belongsTo('App\Category');
    }

    public function apiKey()
    {
        return $this->hasOne('Chrisbjr\ApiGuard\Models\ApiKey');
    }

    public static function find($id, $columns = array('*'))
    {
        $user = parent::find($id, $columns);

        if(is_null($user)) {
            throw new ClientException("User not found.");
        }

        return $user;
    }

    public static function create(array $attributes) 
    {
        $user = new User;
        $user->username = $attributes['username'];
        $user->password = Hash::make($attributes['password']);
        $user->first_name = $attributes['first_name'];
        $user->last_name = $attributes['last_name'];
        $user->email = $attributes['email'];
        $user->category_id = $attributes['category_id'];

        if(!$user->save()) {
            throw new ServerException("User was not created successfully due to an internal server error.");
        }

        $apiKey = new ApiKey;
        $apiKey->key = $apiKey->generateKey();
        $apiKey->user_id = $user->id;
        $apiKey->level = 1;
        $apiKey->ignore_limits = 1;

        if(!$apiKey->save()) {
            $user->delete();
            throw new ServerException("User was not created successfully due to an internal server error.");
        }

        return $user;
    }

    public function update(array $attributes = array()) 
    {
        $this->username = $attributes['username'];
        $this->first_name = $attributes['first_name'];
        $this->last_name = $attributes['last_name'];
        $this->email = $attributes['email'];
        $this->category_id = $attributes['category_id'];

        if(!$this->save()) {
            throw new ServerException("User was not updated successfully due to an internal server error.");
        }
    }

    public function update_password($attributes)
    {
        if(!Hash::check($attributes['old_password'], $this->password)) {
            throw new AuthException("Old password was incorrect.");
        }

        $this->password = Hash::make($attributes['new_password']);

        if(!$this->save()) {
            throw new ServerException("User's password was not updated successfully due to an internal server error.");
        }
    }

    public function delete() 
    {
        $apiKey = $this->apiKey;

        if((!is_null($apiKey) && !$apiKey->delete()) || !parent::delete()) {
            throw new ServerException("User was not deleted successfully due to an internal server error.");
        }
    }
    
}
