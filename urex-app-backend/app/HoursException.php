<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;

class HoursException extends Model {
    
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function getOpenAttribute($value)
    {
        return date("h:ia", strtotime($value));
    }

    public function getCloseAttribute($value)
    {
        return date("h:ia", strtotime($value));
    }

    public static function find($id, $columns = array('*'))
    {
        $hours_exception = parent::find($id, $columns);

        if(is_null($hours_exception)) {
            throw new ClientException("Exception not found.");
        }

        return $hours_exception;
    }

    public static function create(array $attributes)
    {
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->id);

        $hours_exception = new HoursException;
        $hours_exception->date = date("Y-m-d", strtotime($attributes['date']));
        $hours_exception->open = date("H:i:s", strtotime($attributes['open']));
        $hours_exception->close = date("H:i:s", strtotime($attributes['close']));

        if(array_key_exists('category_id', $attributes)) {
            $hours_exception->category_id = $attributes['category_id'];
        } else {
            $hours_exception->category_id = $user->category->id;
        }

        if(!$hours_exception->save()) {
            throw new ServerException("Exception not created successfully due to an internal server error.");
        }

        return $hours_exception;
    }

    public function update(array $attributes = array())
    {
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->id);

        $this->date = date("Y-m-d", strtotime($attributes['date']));
        $this->open = date("H:i:s", strtotime($attributes['open']));
        $this->close = date("H:i:s", strtotime($attributes['close']));

        if(array_key_exists('category_id', $attributes)) {
            $this->category_id = $attributes['category_id'];
        } else {
            $this->category_id = $user->category->id;
        }

        if(!$this->save()) {
            throw new ServerException("Exception was not created successfully due to an internal server error.");
        }
    }

    public function delete()
    {
        if(!parent::delete()) {
            throw new ServerException("Exception was not deleted successfully due to an internal server error.");
        }
    }

}
