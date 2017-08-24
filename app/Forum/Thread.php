<?php

namespace App\Forum;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function path()
    {
        return '/threads/' . $this->id;
    }
}
