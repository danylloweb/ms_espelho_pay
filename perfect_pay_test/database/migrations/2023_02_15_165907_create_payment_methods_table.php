<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePaymentMethodsTable.
 */
class CreatePaymentMethodsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment_methods', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name',50)->comment("nome do metodo de pagamento");
            $table->smallInteger('qty_due_date')->comment("quantidades de dias para vencimento do metodo de pagamento");
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
		Schema::drop('payment_methods');
	}
}
