<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Hour extends Model {

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getMonOpenAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getMonCloseAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getTueOpenAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getTueCloseAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getWedOpenAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getWedCloseAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getThuOpenAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getThuCloseAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getFriOpenAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getFriCloseAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getSatOpenAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getSatCloseAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getSunOpenAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

    public function getSunCloseAttribute($value)
    {
        return date("h:i A", strtotime($value));
    }

}
