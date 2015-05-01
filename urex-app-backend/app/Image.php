<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;
use File;

class Image extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['pivot', 'created_at', 'updated_at'];

    public static function find($id, $columns = array('*'))
    {
        $image = parent::find($id, $columns);

        if(is_null($image)) {
            throw new ClientException("Image not found.");
        }

        return $image;
    }

    public static function create(array $attributes) 
    {
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->id);

        $image = new Image;
        $image->file_location = '';
        $image->caption = $attributes['caption'];

        if(array_key_exists('category_id', $attributes)) {
            $image->category_id = $attributes['category_id'];
        } else {
            $image->category_id = $user->category->id;
        }

        if(!$image->save()) {
            throw new ServerException("Image was not created successfully due to an internal server error.");
        }

        $image->file_location = "images/image_"
                              . strval($image->id)
                              . '.'
                              . $attributes['extension'];

        if(!File::isDirectory(public_path().'/images')) {
            File::makeDirectory(public_path().'/images', 0775);
        }
        $dst = fopen(public_path().'/'.$image->file_location, 'wb');
        if(strpos($attributes['file'], 'data') !== false) {
            $attributes['file'] = explode(',', $attributes['file'])[1];
        }
        File::put(public_path()."/images/temp.data", $attributes['file']);
        $src = fopen(public_path()."/images/temp.data", 'rb');
        while(!feof($src)) {
            fwrite($dst, base64_decode(fread($src, 1024)));
        }
        fclose($src);
        fclose($dst);
        File::delete(public_path()."/images/temp.data");

        if(!$image->save() 
        || !File::exists(public_path() . "/" . $image->file_location)) {
            $image->delete();
            throw new ServerException("Image was not created successfully due to an internal server error.");
        }

        return $image;
    }

    public function delete() 
    {
        File::delete(public_path() . "/" . $this->file_location);

        if(File::exists(public_path() . "/" . $this->file_location) || !parent::delete()) {
            throw new ServerException("Image was not deleted successfully due to an internal server error.");
        }
    }
    
}
