<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPurchaseLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_lines', function (Blueprint $table) {
            $table->foreign(['product_id'])->references(['id'])->on('products')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['tax_id'])->references(['id'])->on('tax_rates')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['transaction_id'])->references(['id'])->on('transactions')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['variation_id'])->references(['id'])->on('variations')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchase_lines', function (Blueprint $table) {
            $table->dropForeign('purchase_lines_product_id_foreign');
            $table->dropForeign('purchase_lines_tax_id_foreign');
            $table->dropForeign('purchase_lines_transaction_id_foreign');
            $table->dropForeign('purchase_lines_variation_id_foreign');
        });
    }
}
