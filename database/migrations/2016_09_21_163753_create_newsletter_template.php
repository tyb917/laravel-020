<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterTemplate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 150)->unique()->nullable()->default(null)->comment('模板代码');
            $table->text('text')->nullable()->comment('模板文本');
            $table->text('style')->nullable()->comment('模板样式');
            $table->string('subject', 200)->nullable()->default(null)->comment('模板主题');
            $table->string('sender_name', 200)->nullable()->default(null)->comment('模板发送人');
            $table->string('sender_email', 200)->nullable()->default(null)->comment('模板发送邮箱');
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
        Schema::table('newsletter_template', function (Blueprint $table) {
            //
        });
    }
}
