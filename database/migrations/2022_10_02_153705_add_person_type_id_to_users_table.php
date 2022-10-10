<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPersonTypeIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('person_type_id');
            $table->foreign('person_type_id')
                ->references('id')
                ->on('person_types')
                ->onDelete('cascade');

            $table->string('document_value');

            $table->unique(['person_type_id', 'document_value']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('person_type_id');
            $table->dropColumn('document_value');
        });
    }
}
