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
            $table->string('order_number')->unique();
            $table->string('item_name');
            $table->string('item_count')->default(1);
            $table->decimal('weight', 20, 2)->default(0.00);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('origin');
            $table->unsignedBigInteger('destination');
            $table->unsignedBigInteger('mode');
            $table->decimal('sub_total', 20, 2)->default(0.00);
            $table->decimal('custom_fee', 20, 2)->default(0.00);
            $table->longText('note')->nullable();
            $table->string('status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('origin')->references('id')->on('countries')->cascadeOnDelete();
            $table->foreign('destination')->references('id')->on('countries')->cascadeOnDelete();
            $table->foreign('mode')->references('id')->on('modes')->cascadeOnDelete();
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
