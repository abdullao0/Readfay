<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\progress;

class Passage extends Model
{

    protected $fillable = [
        'title',
        'content',
        'difficultyLevel',
        'numberOfWords'
    ];

    protected $hidden = [
        'isActive'
    ];
    public function questions(){
        
        return $this->hasMany(Question::class);
    }
    public function progress(){
        
        return $this->hasMany(progress::class);
    }
}
