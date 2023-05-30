<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('matriculation');
            $table->datetime('stardate');
            $table->datetime('enddate');
            $table->integer('state')->default('0');
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->foreignId('designer_id')->nullable()->constrained();
            $table->foreignId('deliver_id')->nullable()->constrained();

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
        Schema::dropIfExists('orders');
    }
}
