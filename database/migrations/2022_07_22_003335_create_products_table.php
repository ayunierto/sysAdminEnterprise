<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('companies_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('warehouses_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('categories_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('marks_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('measures_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('providers_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('bar_code')->nullable();
            $table->bigInteger('stock')->nullable();
            $table->decimal('purchase_price', 11,2)->nullable();
            $table->decimal('sale_price', 11, 2)->nullable();
            $table->decimal('price_by_unit', 11, 2)->nullable();
            $table->decimal('wholesale_price', 11, 2)->nullable();
            $table->decimal('special_price', 11, 2)->nullable();
            $table->integer('stock_min');
            $table->string('description')->nullable();
            $table->boolean('state')->default(1);
            $table->date('expiration_date')->nullable();

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
        Schema::dropIfExists('products');
    }
}
