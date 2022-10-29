<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_profil_app', function (Blueprint $table) {
            $table->id('id_profil_app');
            $table->text('nama');
            $table->string('logo',100);
            $table->string('favicon',100);
            $table->string('no_telp',15)->nullable(true);
            $table->string('email',30)->nullable(true);
            $table->text('alamat')->nullable(true);
            $table->text('facebook')->nullable(true);
            $table->text('instagram')->nullable(true);
            $table->text('tiktok')->nullable(true);
            $table->text('youtube')->nullable(true);
            $table->string('whatsapp', 15)->nullable(true);
            $table->text('telegram')->nullable(true);
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
        Schema::dropIfExists('setting');
    }
}
