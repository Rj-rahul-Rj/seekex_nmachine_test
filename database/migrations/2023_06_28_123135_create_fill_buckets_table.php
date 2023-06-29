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
        Schema::create('fill_buckets', function (Blueprint $table) {
            $table->id();
            $table->integer('bucket_id');
            $table->integer('ball_id');
            $table->float('bucket_volume');
            $table->float('bucket_volume_remains');
            $table->integer('bucket_contain_cubic_inches');
            $table->float('ball_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fill_buckets');
    }
};
