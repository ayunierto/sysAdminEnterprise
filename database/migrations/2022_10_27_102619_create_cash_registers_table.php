<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('companies_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->decimal('amount_pen', 8, 2);
            $table->decimal('amount_usd', 8, 2);
            $table->boolean('state')->default(1);     
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
        Schema::dropIfExists('cash_registers');
    }
}
