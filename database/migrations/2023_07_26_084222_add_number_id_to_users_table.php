<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
			// Verificar si la tabla existe y si tiene el campo.
            if (Schema::hasTable('users') && !Schema::hasColumn('users', 'number_id')) {
				// Si no esta se crea.
                $table->string('number_id')->after('id')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasTable('users') && !Schema::hasColumn('users', 'number_id')) {
                $table->dropColumn('number_id');
            }
        });
    }
};
