<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\Table\TableExtension;

class alertas_aloja extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_alerta';
    
}
