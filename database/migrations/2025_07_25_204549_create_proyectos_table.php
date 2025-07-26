<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table){
        $table->id();
        $table->string('nombre');
        $table->date('fecha_inicio');
        $table->string('estado')->default('en curso');
        $table->string('responsable');
        $table->decimal('monto', 14, 2);
        $table->timestamps();
        }); 
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
