<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('companies_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('providers_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('payment_methods_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('vouchers_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('total', 8, 2);
            $table->boolean('state');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
