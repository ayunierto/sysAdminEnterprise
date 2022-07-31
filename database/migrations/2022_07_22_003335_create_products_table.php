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
            $table->foreignId('categories_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('marks_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('measures_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('providers_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('presentations_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('code');
            $table->bigInteger('bar_code');
            $table->bigInteger('stock');
            $table->decimal('purchase_price', 15,8);
            $table->decimal('sale_price', 15, 8);
            $table->decimal('price_by_unit', 15, 8)->nullable();
            $table->decimal('wholesale_price', 15, 8)->nullable();
            $table->decimal('special_price', 15, 8)->nullable();
            $table->string('description');
            $table->boolean('state');
            $table->date('expiration_date');
            
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
