<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $fillable = [
        'word', 'translation', 'user_id', 'learningPercent'
    ];
}
