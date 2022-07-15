<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model {

    use HasFactory;
    use SoftDeletes;
    
    protected $table = "professores";

    protected $fillable = ['nome', 'email', 'siape','eixo','ativo'];
}
