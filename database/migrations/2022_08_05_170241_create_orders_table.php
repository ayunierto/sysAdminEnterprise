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
            $table->foreignId('companies_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customers_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_methods_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('proof_payments_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('coins_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('documents_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('exchange_rate', 5, 3)->nullable();
            $table->decimal('total', 8, 2);
            $table->date('date');
            $table->boolean('state');
            $table->string('description', 250)->nullable();
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
