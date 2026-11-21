<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tulajdonos', function (Blueprint $table) {
            $table->id('az');
            $table->string('nev');
            $table->string('varos')->nullable();
        });

        Schema::create('hajo', function (Blueprint $table) {
            $table->id('az');
            $table->string('nev');
            $table->string('tipus');
            $table->foreignId('tulaz')->nullable()
                ->constrained('tulajdonos', 'az')->nullOnDelete();
            $table->boolean('uzemel');
        });

        Schema::create('tort', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hajoaz')
                ->constrained('hajo', 'az')->cascadeOnDelete();
            $table->string('nev');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tort');
        Schema::dropIfExists('hajo');
        Schema::dropIfExists('tulajdonos');
    }
};