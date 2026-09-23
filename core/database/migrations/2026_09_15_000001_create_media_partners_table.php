<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaPartnersTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('media_partners')) {
            return;
        }

        Schema::create('media_partners', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('email')->nullable();
            $table->string('category')->default('Confirmed Media Partners');
            $table->string('website')->nullable();
            $table->string('logo')->nullable();
            $table->text('message')->nullable();
            $table->string('status', 30)->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_partners');
    }
}
