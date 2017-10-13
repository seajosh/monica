<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SqliteRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('reminders');

        Schema::create('reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');

            // removed in 2017_02_04_225618_change_reminders_table.php
            // $table->integer('people_id');
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('frequency_type');
            $table->integer('frequency_number')->nullable();
            $table->dateTime('last_triggered')->nullable();
            $table->dateTime('next_expected_date');
            $table->softDeletes();
            $table->timestamps();
            // 2017_02_04_225618_change_reminders_table.php
            $table->integer('contact_id')->nullable()->after('account_id');
            // 2017_06_16_215256_add_about_who_to_reminders.php
            $table->boolean('is_birthday')->after('contact_id')->nullable();


            // reminder_type_id - added in 2016_06_25_224219_create_reminder_type_table.php
            //                    removed in 2017_05_30_002239_remove_predefined_reminders.php

            // is_birthday - modified in 2017_08_02_152838_change_string_to_boolean_for_reminders.php

            // added in 2017_06_16_215256_add_about_who_to_reminders.php
            // removed in 2017_08_06_153253_move_kids_to_contacts.php
            //
            // $table->string('about_object')->after('is_birthday')->nullable();
            // $table->string('about_object_id')->after('about_object')->nullable();
        });
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