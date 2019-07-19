<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogisticsComTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistics_coms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('com')->comment('公司名称');
            $table->string('no')->comment('公司编号');
        });
        DB::statement("ALTER TABLE `logistics_coms` comment '快递公司编号';");
        $this->seed();
        
    }

    public function seed()
    {
        $com_arr = file_get_contents(__DIR__."/database/seeds/com.json");
        DB::table('logistics_coms')->insert(json_decode($com_arr, true));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logistics_com');
    }
}
