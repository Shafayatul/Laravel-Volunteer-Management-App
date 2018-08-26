<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpportunityCommit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'opportunity_commits';

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
    protected $fillable = ['user_id', 'opportunity_id'];

    
}
