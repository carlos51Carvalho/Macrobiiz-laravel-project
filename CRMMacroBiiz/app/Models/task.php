<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_task';
    // protected $fillable = ['nome', 'descricao', 'data'];
}
