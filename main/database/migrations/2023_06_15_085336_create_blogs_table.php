<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        ## Here we have defined the schema of our data. We define the name of the data that is going to be inside the table as well as defining
        ## the data type of each entry
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("content");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        # This checks whether a table of the same name already exists. If it does, the existing table is deleted and replaced by the new schema defined in the migrations.
        Schema::dropIfExists('blogs');
    }
};
