<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'teachers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'first_name', 'last_name', 'phone_number', 'school_name', 'class_one', 'class_two', 'class_three'];

    
}
