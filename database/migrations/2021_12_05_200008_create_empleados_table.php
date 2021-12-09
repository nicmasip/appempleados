<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function(Blueprint $table) {
            $table->id();
            $table->string('nombre', 200);
            $table->string('apellidos', 200);
            $table->string('email', 200);
            $table->string('telefono', 11)->unique();
            $table->date('fechacontrato')->useCurrent();
            $table->bigInteger('idpuesto')->unsigned();
            $table->bigInteger('iddepartamento')->unsigned();
            $table->foreign('idpuesto')->references('id')->on('puesto')->onUpdate('cascade')->nullable();
            $table->foreign('iddepartamento')->references('id')->on('departamento')->onUpdate('cascade');
            $table->timestamps();
        });
        Schema::table('departamento', function(Blueprint $table) {
            $table->foreign('idempleadojefe')->references('id')->on('empleado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado');
    }
}
