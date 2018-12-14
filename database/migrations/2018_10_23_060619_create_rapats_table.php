<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRapatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('tempat');
            $table->timestamp('waktu');
            $table->string('level')->nullable();
            $table->string('tag')->nullable();
            $table->integer('lock');
            $table->integer('isprivate')->default(0);
            $table->string('isi')->nullable();;
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
        Schema::dropIfExists('rapats');
    }
}
