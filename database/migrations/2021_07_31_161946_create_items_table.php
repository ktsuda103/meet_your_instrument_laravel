<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('online_shop')->create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->integer('price');
            $table->string('img');
            $table->integer('status');
            $table->integer('stock');
            $table->string('type');
            $table->text('comment')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        DB::connection('online_shop')->statement("
            create or replace function set_update_time() returns trigger language plpgsql as
            $$
                begin
                    new.updated_at = CURRENT_TIMESTAMP;
                    return new;
                end;
            $$;
        ");

        DB::connection('online_shop')->statement("
            create trigger update_trigger before update on items for each row
            execute procedure set_update_time();
        ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('online_shop')->dropIfExists('items');
        DB::connection('online_shop')->statement("
            DROP TRIGGER update_trigger ON items;
        ");
        DB::connection('online_shop')->statement("
            DROP FUNCTION set_update_time();
        ");
    }
}
