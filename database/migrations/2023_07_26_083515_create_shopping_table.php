<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('shopping', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('customer_user_id')->unsigned();
			$table->bigInteger('products_id')->unsigned();
			$table->enum('status', ['PRESTADO', 'REVISION', 'EN SALA'])->default('EN SALA');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::dropIfExists('shopping');
	}
};
