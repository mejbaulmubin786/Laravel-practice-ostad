<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('firstName', 50);
            $table->string('lastName', 50);
            $table->string('mobile', 50);
            $table->string('city', 50);
            $table->string('shippingAddress', 1000);
            $table->string('email', 50)->unique();
            $table->foreign('email')->references('email')->on('users')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down() {
        Schema::dropIfExists('profiles');
    }
};
