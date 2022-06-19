<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->string('thumbnail_mask')->nullable();
            $table->string('caption')->nullable();
            $table->string('client')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->boolean('featured')->default(0);
            $table->boolean('published')->default(0);
            $table->text('overview')->nullable();
            $table->json('links')->nullable();
            $table->json('content')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
