<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;

class Category extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public static function find($id, $columns = array('*'))
    {
        $category = parent::find($id, $columns);

        if(is_null($category)) {
            throw new ClientException("Category not found.");
        }

        return $category;
    }

    public static function create(array $attributes)
    {
        $category = new Category;
        $category->name = $attributes['name'];

        if(!$category->save()) {
            throw new ServerException("Category was not created successfully due to an internal server error.");
        }

        return $category;
    }

    public function update(array $attributes = array())
    {
        $this->name = $attributes['name'];

        if(!$this->save()) {
            throw new ServerException("Category was not updated successfully due to an internal server error.");
        }

        return $this;
    }

    public function delete() 
    {
        if(!parent::delete()) {
            throw new ServerException("Category was not deleted successfully due to an internal server error.");
        }
    }
    
}