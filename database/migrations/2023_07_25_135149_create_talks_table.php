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
        Schema::create('talks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('out_id')->nullable()->unique();
            $table->integer('in_id')->nullable()->unique();
            $table->dateTime('out_at')->nullable();
            $table->dateTime('in_at')->nullable();
            $table->integer('time')->nullable();
            $table->integer('responsible_user_id')->nullable();
            $table->boolean('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('talks');
    }
};
