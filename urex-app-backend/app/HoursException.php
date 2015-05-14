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

    public function getDayAttribute($value)
    {
        return date("M d, Y", strtotime($value));
    }

    private function validateTime($day, $closed, $open, $close) 
    {
        return $closed ||
              ($open <= $close && 
               count(HoursException::where('day', '=', date("Y-m-d", strtotime($day)))
                                   ->whereNotIn('id', [isset($this->id) ? $this->id : -1])
                                   ->where('open', '<=', date("H:i:s", strtotime($close)))
                                   ->where('close', '>=', date("H:i:s", strtotime($open)))
                                   ->get()->toArray()) === 0);
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
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->user_id);

        $hours_exception = new HoursException;
        if(!$hours_exception->validateTime(
            $attributes['day'], 
            (bool)$attributes['closed'], 
            $attributes['open'], 
            $attributes['close']
           )) {
            throw new ClientException("Time overlaps with existing hours exception record or closing time is before opening time.");
        }

        $hours_exception->day = date("Y-m-d", strtotime($attributes['day']));
        $hours_exception->open = date("H:i:s", strtotime($attributes['open']));
        $hours_exception->close = date("H:i:s", strtotime($attributes['close']));
        $hours_exception->closed = (bool)$attributes['closed'];

        if(array_key_exists('category_id', $attributes)) {
            $hours_exception->category_id = intval($attributes['category_id']);
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
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->user_id);

        if(!$this->validateTime(
            $attributes['day'], 
            (bool)$attributes['closed'], 
            $attributes['open'], 
            $attributes['close']
           )) {
            throw new ClientException("Time overlaps with existing hours exception record or closing time is before opening time.");
        }

        $this->day = date("Y-m-d", strtotime($attributes['day']));
        $this->open = date("H:i:s", strtotime($attributes['open']));
        $this->close = date("H:i:s", strtotime($attributes['close']));
        $this->closed = (bool)$attributes['closed'];

        if(array_key_exists('category_id', $attributes)) {
            $this->category_id = intval($attributes['category_id']);
        } else {
            $this->category_id = $user->category->id;
        }

        if(!$this->save()) {
            throw new ServerException("Exception was not created successfully due to an internal server error.");
        }

        return $this;
    }

    public function delete()
    {
        if(!parent::delete()) {
            throw new ServerException("Exception was not deleted successfully due to an internal server error.");
        }
        return true;
    }

}
