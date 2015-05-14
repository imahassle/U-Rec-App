<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;
use App\Image;
use App\IncentiveProgram;

class ImageIncentiveProgram extends Model {

    protected $table = "image_incentive_program";

    public static function create(array $attributes)
    {
        if(ImageIncentiveProgram::whereImageId($attributes['image_id'])
                                ->where('incentive_program_id', '=', $attributes['incentive_program_id'])
                                ->exists()) {
            throw new ClientException("Image-program association already exists.");
        }

        Image::find($attributes['image_id']);
        IncentiveProgram::find($attributes['incentive_program_id']);

        $image_incentive_program = new ImageIncentiveProgram;
        $image_incentive_program->image_id = $attributes['image_id'];
        $image_incentive_program->incentive_program_id = $attributes['incentive_program_id'];

        if(!$image_incentive_program->save()) {
            throw new ServerException("Image-program association was not created successfully due to an internal server error.");
        }

        return $image_incentive_program;
    }

    public function delete()
    {
        if(!parent::delete())
        {
            throw new ServerException("Image-program association was not deleted successfully due to an internal server error.");
        }
        return true;
    }

}
