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
            $table->increments('id');
            $table->unsignedInteger('business_id')->index();
            $table->unsignedInteger('location_id')->nullable()->index();
            $table->unsignedInteger('res_table_id')->nullable()->index()->comment('fields to restaurant module');
            $table->unsignedInteger('res_waiter_id')->nullable()->index()->comment('fields to restaurant module');
            $table->enum('res_order_status', ['received', 'cooked', 'served'])->nullable()->index();
            $table->string('type')->nullable()->index();
            $table->string('sub_type', 20)->nullable()->index();
            $table->string('status')->index();
            $table->string('sub_status')->nullable()->index();
            $table->boolean('is_quotation')->default(false);
            $table->enum('payment_status', ['paid', 'due', 'partial'])->nullable()->index();
            $table->enum('adjustment_type', ['normal', 'abnormal'])->nullable();
            $table->unsignedInteger('contact_id')->nullable()->index();
            $table->integer('customer_group_id')->nullable()->comment('used to add customer group while selling');
            $table->string('invoice_no')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('subscription_no')->nullable();
            $table->string('subscription_repeat_on')->nullable();
            $table->dateTime('transaction_date')->index();
            $table->decimal('total_before_tax', 22, 4)->default(0)->comment('Total before the purchase/invoice tax, this includeds the indivisual product tax');
            $table->unsignedInteger('tax_id')->nullable()->index('transactions_tax_id_foreign');
            $table->decimal('tax_amount', 22, 4)->default(0);
            $table->enum('discount_type', ['fixed', 'percentage'])->nullable()->index();
            $table->decimal('discount_amount', 22, 4)->nullable()->default(0);
            $table->integer('rp_redeemed')->default(0)->comment('rp is the short form of reward points');
            $table->decimal('rp_redeemed_amount', 22, 4)->default(0)->comment('rp is the short form of reward points');
            $table->string('shipping_details')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('shipping_status')->nullable();
            $table->string('delivered_to')->nullable();
            $table->decimal('shipping_charges', 22, 4)->default(0);
            $table->string('shipping_custom_field_1')->nullable();
            $table->string('shipping_custom_field_2')->nullable();
            $table->string('shipping_custom_field_3')->nullable();
            $table->string('shipping_custom_field_4')->nullable();
            $table->string('shipping_custom_field_5')->nullable();
            $table->text('additional_notes')->nullable();
            $table->text('staff_note')->nullable();
            $table->boolean('is_export')->default(false);
            $table->longText('export_custom_fields_info')->nullable();
            $table->decimal('round_off_amount', 22, 4)->default(0)->comment('Difference of rounded total and actual total');
            $table->decimal('final_total', 22, 4)->default(0);
            $table->unsignedInteger('expense_category_id')->nullable()->index();
            $table->unsignedInteger('expense_for')->nullable()->index('transactions_expense_for_foreign');
            $table->integer('commission_agent')->nullable()->index();
            $table->string('document')->nullable();
            $table->boolean('is_direct_sale')->default(false);
            $table->boolean('is_suspend')->default(false);
            $table->decimal('exchange_rate', 20, 3)->default(1);
            $table->decimal('total_amount_recovered', 22, 4)->nullable()->comment('Used for stock adjustment.');
            $table->integer('transfer_parent_id')->nullable()->index();
            $table->integer('return_parent_id')->nullable()->index();
            $table->integer('opening_stock_product_id')->nullable();
            $table->unsignedInteger('created_by')->index();
            $table->string('prefer_payment_method')->nullable();
            $table->integer('prefer_payment_account')->nullable();
            $table->text('sales_order_ids')->nullable();
            $table->text('purchase_order_ids')->nullable();
            $table->string('custom_field_1')->nullable();
            $table->string('custom_field_2')->nullable();
            $table->string('custom_field_3')->nullable();
            $table->string('custom_field_4')->nullable();
            $table->integer('import_batch')->nullable();
            $table->dateTime('import_time')->nullable();
            $table->integer('types_of_service_id')->nullable()->index();
            $table->decimal('packing_charge', 22, 4)->nullable();
            $table->enum('packing_charge_type', ['fixed', 'percent'])->nullable()->index();
            $table->text('service_custom_field_1')->nullable();
            $table->text('service_custom_field_2')->nullable();
            $table->text('service_custom_field_3')->nullable();
            $table->text('service_custom_field_4')->nullable();
            $table->text('service_custom_field_5')->nullable();
            $table->text('service_custom_field_6')->nullable();
            $table->boolean('is_created_from_api')->default(false);
            $table->integer('rp_earned')->default(0)->comment('rp is the short form of reward points');
            $table->text('order_addresses')->nullable();
            $table->boolean('is_recurring')->default(false);
            $table->double('recur_interval', 22, 4)->nullable();
            $table->enum('recur_interval_type', ['days', 'months', 'years'])->nullable();
            $table->integer('recur_repetitions')->nullable();
            $table->dateTime('recur_stopped_on')->nullable();
            $table->integer('recur_parent_id')->nullable()->index();
            $table->string('invoice_token')->nullable();
            $table->integer('pay_term_number')->nullable();
            $table->enum('pay_term_type', ['days', 'months'])->nullable();
            $table->integer('selling_price_group_id')->nullable()->index();
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
        Schema::dropIfExists('transactions');
    }
}
