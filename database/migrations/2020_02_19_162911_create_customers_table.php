<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('customer_id');
            $table->string('name');
            $table->mediumText('address_line1');
            $table->mediumText('town');
            $table->mediumText('postcode');
            $table->mediumText('email')->nullable();
            $table->mediumText('telephone');
            $table->integer('owner');
            $table->integer('status');
            $table->integer('last_contact_id');
            $table->string('contact_name');
            $table->string('contact_role');
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
        Schema::dropIfExists('customers');
    }
}
