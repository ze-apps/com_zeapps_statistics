<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

class ComZeappsStatistics
{

    public function up()
    {
        Capsule::schema()->create('zeapps_requetes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nom_requete', 255)->default('');
            $table->longText('contenu')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Capsule::schema()->dropIfExists('zeapps_requetes');
    }
}
