<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCustomersTable.
 */
class CreateCustomersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',200)->comment("nome do cliente");
            $table->string('cpfCnpj',14)->comment("documento unico do cliente cpf ou cnpj");
            $table->string('email',200)->nullable()->comment("email do cliente");
            $table->string('mobilePhone',14)->nullable()->comment("telefone movel do cliente");
            $table->boolean('sync')->default(false);
            $table->string('code_asaas',100)->nullable();
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
		Schema::drop('customers');
	}
}
