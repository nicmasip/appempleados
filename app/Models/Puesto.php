<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    
    protected $table = 'puesto';
    
    public $timestamps = false;
    
    protected $fillable = ['nombre', 'minimo', 'maximo', ];
    
    protected $attributes = ['minimo' => 0, 'maximo' => 0, ];
    
    public function empleados() {
        return $this->hasMany('App\Models\Empleado', 'idpuesto');
    }
}
