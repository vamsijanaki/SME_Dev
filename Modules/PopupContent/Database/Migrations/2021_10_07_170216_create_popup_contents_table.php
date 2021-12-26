<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePopupContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('popup_contents', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->text('title')->nullable();
            $table->text('message')->nullable();
            $table->text('link')->nullable();
            $table->text('btn_txt')->nullable();
            $table->timestamps();
        });

        $popup = new \Modules\PopupContent\Entities\PopupContent();
        $popup->image = 'public/uploads/popup/1.png';
        $popup->title = 'Want to get more offer?';
        $popup->message = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.";
        $popup->link = '/';
        $popup->btn_txt = 'Visit Website';
        $popup->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popup_contents');
    }
}
