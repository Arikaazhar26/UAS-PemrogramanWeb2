<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('members', function (Blueprint $table) {

        $table->id();

        // Nomor anggota
        $table->string('member_code',30)->unique();

        // Data anggota
        $table->string('name',100);
        $table->enum('gender',['Laki-laki','Perempuan']);

        $table->string('phone',20);
        $table->string('email')->unique();

        $table->text('address');

        // Foto anggota
        $table->string('photo')->nullable();

        // Status anggota
        $table->enum('status',['Aktif','Nonaktif'])
              ->default('Aktif');

        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
