<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docencia extends Model {
    
    use HasFactory;

    protected $fillable = ['professor_id','disciplina_id','ano'];

    public function disciplina() {
        return $this->belongsTo('App\Models\Disciplina');
    }

    public function professor() {
        return $this->belongsTo('App\Models\Professor');
    }
}
