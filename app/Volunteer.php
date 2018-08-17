<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'volunteers';

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
    protected $fillable = ['user_id', 'first_name', 'last_name', 'phone_number', 'provide_detail', 'current_employer', 'years_of_experience', 'linkedin', 'instagram', 'facebook', 'twitter', 'image'];

    
}
