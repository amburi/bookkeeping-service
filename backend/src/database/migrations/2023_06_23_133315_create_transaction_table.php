<?php

use App\Enums\TransactionType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {

            $transactionTypes = [
                TransactionType::DEPOSIT,
                TransactionType::WITHDRAW,
                TransactionType::BUY,
                TransactionType::SELL
            ];

            $table->bigIncrements('id');
            $table->enum('type', $transactionTypes)->default(TransactionType::DEPOSIT);
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->unsignedBigInteger('party_id');
            $table->unsignedBigInteger('counterparty_id');
            $table->integer('quantity')->default(0);
            $table->float('total_amount')->default(0)->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->index('party_id');
            $table->index('counterparty_id');
            $table->index('asset_id');

            $table->foreign('party_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('counterparty_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
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
