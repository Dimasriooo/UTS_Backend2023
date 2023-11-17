<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //membuat table pegawai
        Schema::create('pegawais', function (Blueprint $table) {
            //membuat kolom
            $table->id();
            $table->string('name');
            $table->enum('gender', ['laki laki', 'perempuan']);
            $table->string('phone');
            $table->string('alamat');
            $table->string('email');
            $table->enum('status', ['active', 'inactive', 'terminated']);
            $table->string('hired_on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
