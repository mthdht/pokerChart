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

    /**
     * Get the score's benefice.
     *
     * @return number
     */
    public function getBeneficeAttribute()
    {
        return $this->gains - $this->mise;
    }

    /**
     * Get the score's benefice.
     *
     * @return string
     */
    public function getRecaveAttribute()
    {
        return (int)($this->mise / $this->buyIn);
    }
}
