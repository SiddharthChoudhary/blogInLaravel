<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasTable("Blog")){
            Schema::create('Blog',function (Blueprint $table){
                $table->increments('id');
                $table->text('title');
                $table->longText('blogtext');
                $table->date('date_created');
                $table->text('author');
                $table->text('author_id');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
