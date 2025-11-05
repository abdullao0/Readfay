<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [  
        'passage_id',
        'question',
        'option1',
        'option2',
        'option3',
        'CorrectOption',
    ];

    public function passage(){
        
        return $this->belongsTo(Passage::class);
    }
}
