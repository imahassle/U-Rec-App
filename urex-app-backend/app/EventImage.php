<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;
use App\Event;
use App\Image;

class EventImage extends Model {

    protected $table = "event_image";

    public static function create(array $attributes)
    {
        if(EventImage::whereEventId($attributes['event_id'])
                     ->where('image_id', '=', $attributes['image_id'])
                     ->exists()) {
            throw new ClientException("Event-image association already exists.");
        }

        Event::find($attributes['event_id']);
        Image::find($attributes['image_id']);

        $event_image = new EventImage;
        $event_image->event_id = $attributes['event_id'];
        $event_image->image_id = $attributes['image_id'];

        if(!$event_image->save()) {
            throw new ServerException("Event-image association was not created successfully due to an internal server error.");
        }

        return $event_image;
    }

    public function delete()
    {
        if(!parent::delete())
        {
            throw new ServerException("Event-image association was not deleted successfully due to an internal server error.");
        }
        return true;
    }

}
