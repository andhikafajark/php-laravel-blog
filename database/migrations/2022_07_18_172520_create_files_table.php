<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('original_name');
            $table->string('hash_name');
            $table->string('path')->nullable();
            $table->string('extension');
            $table->string('mime_type');
            $table->unsignedBigInteger('size');
            $table->uuid('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->uuid('updated_by')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->uuid('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
