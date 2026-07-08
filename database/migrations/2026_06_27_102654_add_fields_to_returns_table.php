<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('returns', function (Blueprint $table) {

        $table->foreignId('borrowing_id')
              ->after('id')
              ->constrained()
              ->onDelete('cascade');

        $table->date('return_date')
              ->after('borrowing_id');

        $table->enum('condition', [
            'Baik',
            'Rusak Ringan',
            'Rusak Berat',
            'Hilang'
        ])->default('Baik');

        $table->text('note')->nullable();

    });
}
 
    public function down(): void
{
    Schema::table('returns', function (Blueprint $table) {

        $table->dropForeign(['borrowing_id']);

        $table->dropColumn([
            'borrowing_id',
            'return_date',
            'condition',
            'note'
        ]);

    });
}
};
