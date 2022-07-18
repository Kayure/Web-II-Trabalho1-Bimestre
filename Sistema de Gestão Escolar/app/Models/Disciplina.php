<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disciplina extends Model {

    use HasFactory;
    use SoftDeletes;
    
    protected $table = "disciplinas";

    protected $fillable = ['nome', 'curso', 'sigla'];
    public function curso() {
        return $this->belongsTo('\App\Models\Curso');
    }

    public function area() {
        return $this->belongsTo('\App\Models\Area');
    }
}
