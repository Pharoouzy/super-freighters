<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->decimal('amount', 20, 2);
            $table->string('authorization_url')->nullable();
            $table->string('access_code')->nullable();
            $table->string('response_code')->nullable()->comment('00 = Successful, 11 = Not successful');
            $table->longText('response_description')->nullable()->comment('Successful Transaction, Pending Transaction, Failed Transaction');
            $table->string('status')->default(0)->comment('0 = Failed 1 = Successful 2 = Pending');
            $table->json('response_full')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
