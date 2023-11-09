<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId("category_id")->nullable()->constrained('categories')->onDelete('cascade');

            $table->string("name");
            $table->string("slug")->nullable();
            $table->string("sku")->nullable()->unique();
            $table->string("barcode")->nullable()->unique();
            $table->string("type")->default('product')->nullable();
            $table->string("about")->nullable();
            $table->longText("description")->nullable();
            $table->longText("details")->nullable();

            //Prices
            $table->double("price");
            $table->double("discount")->default(0)->nullable();
            $table->datetime("discount_to")->nullable();
            $table->double("vat")->default(0)->nullable();

            $table->boolean("is_in_stock")->default(1)->nullable();
            $table->boolean("is_activated")->default(1)->nullable();
            $table->boolean("is_shipped")->default(0)->nullable();
            $table->boolean("is_trend")->default(0)->nullable();
            $table->boolean("has_options")->default(0)->nullable();
            $table->boolean("has_multi_price")->default(0)->nullable();
            $table->boolean("has_unlimited_stock")->default(0)->nullable();
            $table->boolean("has_max_cart")->default(0)->nullable();
            $table->bigInteger("min_cart")->nullable()->unsigned();
            $table->bigInteger("max_cart")->nullable()->unsigned();
            $table->boolean("has_stock_alert")->default(0)->nullable();
            $table->bigInteger("min_stock_alert")->nullable()->unsigned();
            $table->bigInteger("max_stock_alert")->nullable()->unsigned();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
