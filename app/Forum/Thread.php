<?php

namespace App\Forum;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    /**
     * Helper function to send the path of the current thread
     * @return string
     */
    public function path()
    {
        return '/threads/' . $this->id;
    }

    /**
     * Relationship to replies from thread
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Relationship to the Owner of the thread
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Creates a reply on the thread
     * @param $reply
     */
    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }
}

