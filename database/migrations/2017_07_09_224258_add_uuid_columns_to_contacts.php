<?php

use App\Contact;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Migrations\Migration;

class AddUuidColumnsToContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function ($table) {
            $table->string('uuid')->after('account_id')->nullable();
        });

        foreach (Contact::all() as $contact) {
            $contact->uuid = Hashids::encode($contact->id);
            $contact->save();
        }
    }
}
