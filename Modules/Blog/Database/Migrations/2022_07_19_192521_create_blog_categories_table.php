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
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->comment('Unique');
            $table->string('slug')->comment('Unique');
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
        Schema::dropIfExists('blog_categories');
    }
};
