<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    
    protected $table = 'empleado';
    
    protected $fillable = ['nombre', 'apellidos', 'email', 'telefono', 'fechacontrato', 'idpuesto', 'iddepartamento', ];
    
    public function puesto() {
        return $this->belongsTo('App\Models\Puesto', 'idpuesto');
    }
    
    public function departamento() {
        return $this->belongsTo('App\Models\Departamento', 'iddepartamento');
    }
}
