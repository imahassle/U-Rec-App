<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Chrisbjr\ApiGuard\Models\ApiKey;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;
use App\ImageIncentiveProgram;

class IncentiveProgram extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function images() {
        return $this->belongsToMany('App\Image');
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
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->id);

        $incentive_program = new IncentiveProgram;
        $incentive_program->title = $attributes['title'];
        $incentive_program->description = $attributes['description'];
        $incentive_program->user_id = $user->id;

        if(!$incentive_program->save()) {
            throw new ServerException("Program was not created successfully due to an internal server error.");
        }

        return $incentive_program;
    }

    public function update(array $attributes = array())
    {
        $user = User::find(ApiKey::whereKey($attributes['X-Authorization'])->first()->id);

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
        $associations = ImageIncentiveProgram::whereIncentiveProgramId($this->id);
        if(count($associations->get()) != $associations->delete() || !parent::delete()) {
            throw new ServerException("Program was not deleted successfully due to an internal server error.");
        }
    }

    public function associate_image($image_id)
    {
        ImageIncentiveProgram::create(['image_id' => $image_id, 'incentive_program_id' => $this->id]);
    }

    public function dissociate_image($image_id)
    {
        ImageIncentiveProgram::whereImageId($image_id)->where('incentive_program_id', '=', $this->id)->delete();
    }
    
}
