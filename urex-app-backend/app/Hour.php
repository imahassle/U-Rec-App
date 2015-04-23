<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;

class Hour extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function getOpenAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getCloseAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public static function find($id, $columns = array('*'))
    {
        $hour = parent::find($id, $columns);

        if(is_null($hour)) {
            throw new ClientException("Hours not found.");
        }

        return $hour;
    }

    public static function create(array $attributes)
    {
        $user = ApiKey::whereKey($attributes['X-Authorization'])->first()->user;

        $hour = new Hour;
        $hour->open = date("h:i:s", strtotime($attributes['open']));
        $hour->close = date("h:i:s", strtotime($attributes['close']));
        $hour->day_of_week = $attributes['day_of_week'];

        if(array_key_exists('category_id', $attributes)) {
            $hour->category_id = $attributes['category_id'];
        } else {
            $hour->category_id = $user->category->id;
        }

        if(!$hour->save()) {
            throw new ServerException("Hours were not created successfully due to an internal server error.");
        }

        return $hour;
    }

    public function update(array $attributes = array())
    {
        $user = ApiKey::whereKey($attributes['X-Authorization'])->first()->user;

        $this->open = date("h:i A", strtotime($attributes['open']));
        $this->close = date("h:i A", strtotime($attributes['close']));
        $this->day_of_week = $attributes['day_of_week'];

        if(array_key_exists('category_id', $attributes)) {
            $this->category_id = $attributes['category_id'];
        } else {
            $this->category_id = $user->category->id;
        }

        if(!$this->save()) {
            throw new ServerException("Hours were not created successfully due to an internal server error.");
        }
    }

    public function delete()
    {
        if(!parent::delete()) {
            throw new ServerException("Hours were not deleted successfully due to an internal server error.");
        }
    }

}
