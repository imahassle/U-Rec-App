<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;
use App\HoursException;
use App\Category;
use DB;

class Hour extends Model {

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

    private function validateTime($day_of_week, $closed, $open, $close) 
    {
        return $closed || 
              ($open <= $close &&
               count(Hour::whereDayOfWeek($day_of_week)
                    ->whereNotIn('id', [isset($this->id) ? $this->id : -1])
                    ->where('open', '<=', date("H:i:s", strtotime($close)))
                    ->where('close', '>=', date("H:i:s", strtotime($open)))
                    ->get()->toArray()) === 0);
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
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->user_id);

        $hour = new Hour;
        if(!$hour->validateTime(
            $attributes['day_of_week'], 
            (bool)$attributes['closed'], 
            $attributes['open'], 
            $attributes['close']
           )) {
            throw new ClientException("Time overlaps with existing hours record or closing time is before opening time.");
        }

        $hour->open = date("H:i:s", strtotime($attributes['open']));
        $hour->close = date("H:i:s", strtotime($attributes['close']));
        $hour->closed = (bool)$attributes['closed'];
        $hour->day_of_week = intval($attributes['day_of_week']);

        if(array_key_exists('category_id', $attributes)) {
            $hour->category_id = intval($attributes['category_id']);
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
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->user_id);

        if(!$this->validateTime(
            $attributes['day_of_week'], 
            (bool)$attributes['closed'], 
            $attributes['open'], 
            $attributes['close']
           )) {
            throw new ClientException("Time overlaps with existing hours record or closing time is before opening time.");
        }

        $this->open = date("H:i:s", strtotime($attributes['open']));
        $this->close = date("H:i:s", strtotime($attributes['close']));
        $this->closed = (bool)$attributes['closed'];
        $this->day_of_week = intval($attributes['day_of_week']);

        if(array_key_exists('category_id', $attributes)) {
            $this->category_id = intval($attributes['category_id']);
        } else {
            $this->category_id = $user->category->id;
        }

        if(!$this->save()) {
            throw new ServerException("Hours were not created successfully due to an internal server error.");
        }

        return $this;
    }

    public function delete()
    {
        if(!parent::delete()) {
            throw new ServerException("Hours were not deleted successfully due to an internal server error.");
        }
    }

    public static function getNextWeek($day, $category_id)
    {
        $schedule = [];
        $days = [ "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday" ];

        for($i = 0; $i < 7; $i++) {
            $day_number = date("w", strtotime("+".$i." days", strtotime($day)));
            $temp = [ "day" => $days[$day_number] ];

            $hours_prefix = Hour::whereCategoryId($category_id)
                                ->whereDayOfWeek($day_number);
            $hours = $hours_prefix->orderBy('open', 'ASC')
                                  ->get(['open', 'close'])
                                  ->toArray();

            $exceptions_prefix = HoursException::where('day', '=', date("Y-m-d", strtotime("+" . $i . " days", strtotime($day))));
            $exceptions = $exceptions_prefix->orderBy('open', 'ASC')
                                            ->get(['open', 'close'])
                                            ->toArray();

            $hours_closed = count($hours) === 0 || !$hours_prefix->whereClosed(true)->get()->isEmpty();
            $exceptions_closed = !$exceptions_prefix->whereClosed(true)->get()->isEmpty();

            $closed = $exceptions_closed || ($hours_closed && count($exceptions) === 0);

            if($closed) {
                $temp["closed"] = $closed;
                $schedule[] = $temp;
                continue;
            }

            $temp["times"] = [];

            if(empty($exceptions)) {
                foreach($hours as $entry) {
                    $temp["times"][] = $entry["open"] . " - " . $entry["close"];
                }
                $schedule[] = $temp;
                continue;
            }

            foreach($exceptions as $entry) {
                $temp["times"][] = $entry["open"] . " - " . $entry["close"];
            }
            $schedule[] = $temp;
        }

        return $schedule;
    }

}
