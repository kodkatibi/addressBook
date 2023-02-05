<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->uuid()->autoIncrement()->primary();
            $table->foreignUuid('contact_uuid');
            $table->enum('info_type', ['phone', 'email', 'location']);
            $table->string('info_value');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contact_infos');
    }
};
