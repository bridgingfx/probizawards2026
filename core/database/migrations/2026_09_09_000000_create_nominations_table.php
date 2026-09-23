<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominationsTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('nominations')) {
            return;
        }

        Schema::create('nominations', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('contact');
            $table->string('jobtitle');
            $table->string('email');
            $table->string('confirm_email');
            $table->string('phone', 30);
            $table->string('country');
            $table->string('category');
            $table->string('subcategory');
            $table->text('statement');
            $table->text('description');
            $table->boolean('consent1')->default(false);
            $table->boolean('consent2')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nominations');
    }
}
