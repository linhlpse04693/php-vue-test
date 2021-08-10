<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelatedFieldInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('avatar')->nullable();
            $table->string('username')->nullable();
            $table->foreignId('status_id')
                ->constrained('statuses')
                ->onDelete('cascade');
            $table->foreignId('role_id')
                ->constrained('roles')
                ->onDelete('cascade');
            $table->string('company')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->string('language')->nullable();
            $table->boolean('gender')->nullable();
            $table->json('contact_options')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
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
            $table->dropForeign(['status_id']);
            $table->dropForeign(['role_id']);
            $table->dropColumn([
                'avatar',
                'username',
                'company',
            ]);
        });
    }
}
