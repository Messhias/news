<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    //
	
	protected $table = "news";


    /**
     * Get users.
     */
    public function users()
    {
        return $this->hasMany('App\User','id','user_id');
    }

}
