<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'buyIn', 'mise', 'gains', 'datePartie',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
