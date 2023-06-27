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
        Schema::table('players', function (Blueprint $table) {
            DB::table('players')->insert(
                ['name_player'=>'Nguyen Van A', 'age_player'=>'22', 'salary'=>'1000', 'position'=>'CM'] 
            );
            DB::table('players')->insert(
                ['name_player'=>'Nguyen Van B', 'age_player'=>'23', 'salary'=>'1200', 'position'=>'CM'] 
            );
            DB::table('players')->insert(
                ['name_player'=>'Nguyen Van C', 'age_player'=>'24', 'salary'=>'1300', 'position'=>'CM'] 
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            //
        });
    }
};
