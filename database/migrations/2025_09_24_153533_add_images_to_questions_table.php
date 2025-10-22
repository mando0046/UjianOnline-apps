<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->string('question_image')->nullable()->after('question');
            $table->string('option_image_a')->nullable()->after('option_a');
            $table->string('option_image_b')->nullable()->after('option_b');
            $table->string('option_image_c')->nullable()->after('option_c');
            $table->string('option_image_d')->nullable()->after('option_d');
            $table->string('option_image_e')->nullable()->after('option_e');
        });
    }

    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['image', 'option_image_a', 'option_image_b', 'option_image_c', 'option_image_d', 'option_image_e']);
        });
    }
};
