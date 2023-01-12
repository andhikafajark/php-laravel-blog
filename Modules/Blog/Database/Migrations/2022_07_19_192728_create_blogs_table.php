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
        Schema::create('blogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('blog_category_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
            $table->string('title')->comment('Unique');
            $table->string('slug')->comment('Unique');
            $table->longText('content');
            $table->uuid('headline_image_id')->nullable();
            $table->foreign('headline_image_id')->references('id')->on('files')->cascadeOnUpdate()->nullOnDelete();
            $table->boolean('is_active')->default(false);
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
        Schema::dropIfExists('blogs');
    }
};
