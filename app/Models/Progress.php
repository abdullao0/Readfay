<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{

    protected $fillable = [
        'user_id',
        'passage_id',
        'WPM',
        'Duration',
        'TestScore'
    ];

    public function passage(){
        
        return $this->belongsTo(Passage::class);
    }
}
