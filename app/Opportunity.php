<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'opportunities';

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
    protected $fillable = ['user_id', 'title', 'date', 'start_time', 'end_time', 'address', 'contact_number', 'contact_name', 'contact_email', 'is_volunteer_limit', 'number_of_volunteer', 'detail', 'number_of_student', 'is_call', 'subject1', 'subject2', 'subject3', 'subject4', 'subject5', 'subject6', 'subject7', 'subject8', 'is_published'];

    
}
