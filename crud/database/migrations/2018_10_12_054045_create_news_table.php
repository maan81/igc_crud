<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('title', 50);
            $table->text('content');
            $table->string('Highlights', 200);
            $table->string('author', 50);
            $table->dateTime('Published_date');

            $table->integer('category_id')->unsigned();
            $table->string('category_name', 50);

            $table->softDeletes();
        });

        Schema::table('news', function($table) {
            $table->foreign('category_id')->references('id')->on('categories');
            // $table->foreign('category_name')->references('name')->on('categories');
        });

    }

    public function categories()
    {
        return $this->belongsTo('App\Categories', 'foreign_key');
        // return $this->belongsTo('App\User');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
