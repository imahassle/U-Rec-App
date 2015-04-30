<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ClientException;
use App\Exceptions\ServerException;

class ItemRental extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public static function find($id, $columns = array('*'))
    {
        $item_rental = parent::find($id, $columns);

        if(is_null($item_rental)) {
            throw new ClientException("Item not found.");
        }

        return $item_rental;
    }

    public static function create(array $attributes)
    {
        $item_rental = new ItemRental;
        $item_rental->name = $attributes['name'];
        $item_rental->faculty_pricing_1 = $attributes['faculty_pricing_1'];
        $item_rental->faculty_pricing_2 = $attributes['faculty_pricing_2'];
        $item_rental->faculty_pricing_3 = $attributes['faculty_pricing_3'];
        $item_rental->faculty_pricing_4 = $attributes['faculty_pricing_4'];
        $item_rental->student_pricing_1 = $attributes['student_pricing_1'];
        $item_rental->student_pricing_2 = $attributes['student_pricing_2'];
        $item_rental->student_pricing_3 = $attributes['student_pricing_3'];
        $item_rental->student_pricing_4 = $attributes['student_pricing_4'];

        if(!$item_rental->save()) {
            throw new ServerException("Item was not created successfully due to an internal server error.");
        }

        return $item_rental;
    }

    public function update(array $attributes = array())
    {
        $this->name = $attributes['name'];
        $this->faculty_pricing_1 = $attributes['faculty_pricing_1'];
        $this->faculty_pricing_2 = $attributes['faculty_pricing_2'];
        $this->faculty_pricing_3 = $attributes['faculty_pricing_3'];
        $this->faculty_pricing_4 = $attributes['faculty_pricing_4'];
        $this->student_pricing_1 = $attributes['student_pricing_1'];
        $this->student_pricing_2 = $attributes['student_pricing_2'];
        $this->student_pricing_3 = $attributes['student_pricing_3'];
        $this->student_pricing_4 = $attributes['student_pricing_4'];

        if(!$this->save()) {
            throw new ServerException("Item was not updated successfully due to an internal server error.");
        }

        return $this;
    }

    public function delete() 
    {
        if(!parent::delete()) {
            throw new ServerException("Item was not deleted successfully due to an internal server error.");
        }
    }
}
