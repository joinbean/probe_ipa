<?php

use App\Models\Category;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrophiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trophies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Type::class);
            $table->string('title');
            $table->integer('ranking');
            $table->date('date');
            $table->foreignIdFor(Category::class)->nullable($value = true);
            $table->string('place');
            $table->string('oponent');
            $table->string('score');
            $table->integer('price');
            $table->string('club_name');
            $table->string('image');
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
        Schema::dropIfExists('trophies');
    }
}
