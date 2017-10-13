<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SqliteContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('contacts');

        // 2016_06_08_005413_create_contacts_table.php
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id')->default(0);
            // removed - 2017_01_22_142645_add_fields_to_contacts.php
            // $table->integer('entity_id')->nullable();
            //
            $table->enum('status', ['adult', 'parent', 'kid'])->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('surname')->nullable();
            // changed below
            // $table->enum('gender', ['male', 'female']);
            //
            $table->enum('nature_of_relationship', ['friend', 'family', 'friend_of_friend', 'business'])->nullable();
            $table->enum('couple_status', ['married', 'engaged', 'complicated', 'dates', 'single'])->nullable();
            $table->string('is_birthdate_approximate')->default('false')->nullable();
            $table->dateTime('birthdate')->nullable();
            $table->string('warned_about_birthdate')->default('true');
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->nullable();
            // removed - 2017_01_22_142645_add_fields_to_contacts.php
            // $table->string('twitter_id')->nullable();
            //
            // removed - 2017_01_22_142645_add_fields_to_contacts.php
            // $table->string('instagram_id')->nullable();
            //
            $table->string('is_first_met_date_approximate')->default('false')->nullable();
            $table->dateTime('first_met')->nullable();
            $table->string('first_met_where')->nullable();
            $table->longText('first_met_additional_info')->nullable();
            $table->string('job')->nullable();
            // changed below
            // $table->dateTime('last_talked_to')->nullable();
            //
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
            $table->integer('country_id')->nullable();
            $table->longText('food_preferencies')->nullable();
            // changed below
            // $table->string('has_kids')->default('false')->nullable();
            //
            $table->integer('first_parent_id')->nullable();
            $table->integer('second_parent_id')->nullable();
            $table->dateTime('viewed_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
            // 2017_01_22_142645_add_fields_to_contacts.php
            $table->string('has_kids')->default('false')->after('gender');
            $table->integer('number_of_kids')->default('0')->after('has_kids');
            $table->date('last_talked_to')->nullable()->after('number_of_kids');
            // 2017_06_07_173437_add_multiple_genders_choices.php
            $table->string('gender')->default('none');
            // 2017_01_15_045025_add_colors_to_users.php
            $table->string('default_avatar_color')->nullable();
            // 2016_09_03_202027_add_reminder_id_to_contacts.php
            $table->integer('birthday_reminder_id')->nullable()->after('birthdate');

            // 2017_07_26_220021_change_contacts_table.php
            $table->boolean('is_significant_other')->after('gender')->default(0);
            $table->boolean('is_kid')->after('is_significant_other')->default(0);

            // people_id - added in 2016_09_05_135927_add_people_id_to_contacts.php
            //             removed in 2017_01_22_142645_add_fields_to_contacts.php

            // number_of_reminders - added in 2017_01_22_142645_add_fields_to_contacts.php
            //                       removed in 2017_07_17_005012_drop_reminders_count_from_contacts.php
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