<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;
use App\EventImage;
use App\Image;

class Event extends Model {
    
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['image'];

    public function images() 
    {
        return $this->belongsToMany('App\Image');
    }

    public function getStartAttribute($value)
    {
        return date("M d, Y h:ia", strtotime($value));
    }

    public function getEndAttribute($value)
    {
        return date("M d, Y h:ia", strtotime($value));
    }

    public function getImageAttribute()
    {
        $image = $this->images()->first();
        if(is_null($image)) {
            return null;
        }
        else {
            return $image->file_location;
        }
    }

    public static function find($id, $columns = array('*'))
    {
        $event = parent::find($id, $columns);

        if(is_null($event)) {
            throw new ClientException("Event not found.");
        }

        return $event;
    }

    public static function create(array $attributes)
    {
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->user_id);

        $event = new Event;
        $event->title = $attributes['title'];
        $event->description = $attributes['description'];
        $event->start = date("Y-m-d H:i:s", strtotime($attributes['start']));
        $event->end = date("Y-m-d H:i:s", strtotime($attributes['end']));
        $event->cost = floatval($attributes['cost']);
        $event->spots = intval($attributes['spots']);
        $event->gear_needed = $attributes['gear_needed'];
        $event->user_id = $user->id;

        if(array_key_exists('category_id', $attributes)) {
            $event->category_id = intval($attributes['category_id']);
        } else {
            $event->category_id = $user->category->id;
        }

        if(!$event->save()) {
            throw new ServerException("Event was not created successfully due to an internal server error.");
        }

        if(array_key_exists('image', $attributes) && array_key_exists('file', $attributes['image'])) {
            $image = Image::create([
                'X-Authorization' => $attributes['X-Authorization'], 
                'file' => $attributes['image']['file'],
                'extension' => $attributes['image']['extension'],
                'category_id' => $event->category_id,
                'caption' => $event->title
            ]);
            EventImage::create(['event_id' => $event->id, 'image_id' => $image->id]);
        }

        return $event;
    }

    public function update(array $attributes = array())
    {
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->user_id);

        $this->title = $attributes['title'];
        $this->description = $attributes['description'];
        $this->start = date("Y-m-d H:i:s", strtotime($attributes['start']));
        $this->end = date("Y-m-d H:i:s", strtotime($attributes['end']));
        $this->cost = floatval($attributes['cost']);
        $this->spots = intval($attributes['spots']);
        $this->gear_needed = $attributes['gear_needed'];
        $this->user_id = $user->id;

        if(array_key_exists('category_id', $attributes)) {
            $this->category_id = intval($attributes['category_id']);
        } else {
            $this->category_id = $user->category()->id;
        }

        if(!$this->save()) {
            throw new ServerException("Event was not updated successfully due to an internal server error.");
        }

        return $this;
    }

    public function delete() 
    {
        $association = EventImage::whereEventId($this->id)->first();
        if(!is_null($association)) {
            if(!$association->delete()) {
                throw new ServerException("Event was not deleted successfully due to an internal server error.");
            }
        }
        if(!parent::delete()) {
            echo "NO HERE!";
            throw new ServerException("Event was not deleted successfully due to an internal server error.");
        }
        return true;
    }

}
