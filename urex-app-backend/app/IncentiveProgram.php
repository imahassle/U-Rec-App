<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;
use App\ImageIncentiveProgram;

class IncentiveProgram extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['image'];

    public function images() 
    {
        return $this->belongsToMany('App\Image');
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
            throw new ClientException("Program not found.");
        }

        return $event;
    }

    public static function create(array $attributes)
    {
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->user_id);

        $incentive_program = new IncentiveProgram;
        $incentive_program->title = $attributes['title'];
        $incentive_program->description = $attributes['description'];
        $incentive_program->user_id = $user->id;

        if(!$incentive_program->save()) {
            throw new ServerException("Program was not created successfully due to an internal server error.");
        }

        if(array_key_exists('image', $attributes) && array_key_exists('file', $attributes['image'])) {
            $image = Image::create([
                'X-Authorization' => $attributes['X-Authorization'], 
                'file' => $attributes['image']['file'],
                'extension' => $attributes['image']['extension'],
                'caption' => $incentive_program->title
            ]);
            ImageIncentiveProgram::create(['image_id' => $image->id, 'incentive_program_id' => $incentive_program->id]);
        }

        return $incentive_program;
    }

    public function update(array $attributes = array())
    {
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->user_id);

        $this->title = $attributes['title'];
        $this->description = $attributes['description'];
        $this->user_id = $user->id;

        if(!$this->save()) {
            throw new ServerException("Program was not updated successfully due to an internal server error.");
        }

        return $this;
    }

    public function delete()
    {
        $association = ImageIncentiveProgram::whereIncentiveProgramId($this->id)->first();
        if(!is_null($association)) {
            if(!$association->delete()) {
                throw new ServerException("Program was not deleted successfully due to an internal server error.");
            }
        }
        if(!parent::delete()) {
            throw new ServerException("Program was not deleted successfully due to an internal server error.");
        }
    }

}
