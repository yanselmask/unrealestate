<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->text('values')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });
        //
        Schema::create('report_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('reason');
            $table->string('description')->nullable();
            $table->timestamps();
        });
        Schema::create('user_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reason_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('property_id');
            $table->text('another_message')->nullable();
            $table->timestamps();
        });
        //
        Schema::create('outdoors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon')
                ->nullable();
            $table->string('image')
                ->nullable();
            $table->timestamps();
        });
        //
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->json('price')->nullable();
            $table->string('interval');
            $table->integer('duration');
            $table->string('listing_limit');
            $table->string('ads_limit');
            $table->json('features')->nullable();
            $table->boolean('is_recommended')->default(false);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        Schema::create('user_purchased_packages', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');
            $table->unsignedBigInteger('package_id');
            $table->timestamp('start_at');
            $table->timestamp('end_at')->nullable();
            $table->timestamp('canceled_at')->nullable();
            $table->integer('used_listing')->default(0);
            $table->integer('used_ads')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->integer('amount');
            $table->string('payment_gateway');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('customer_id');
            $table->tinyInteger('status');
            $table->timestamps();
        });
        //
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email');
            $table->text('message');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
        //
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('category_id');
            $table->tinyInteger('property_type')->default(0);
            $table->unsignedBigInteger('listing_as_id');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('address');
            $table->json('location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('description');
            $table->string('rent_interval')->nullable();
            $table->integer('rent_duration')->nullable();
            $table->string('main_image')->nullable();
            $table->string('virtual_link')->nullable();
            $table->string('video_link')->nullable();
            $table->json('contact')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamp('verified')->nullable();
            $table->timestamp('featured')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        //
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('stars');
            $table->text('message')->nullable();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        //
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('property_id')->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->timestamp('booking')->nullable();
            $table->text('message')->nullable();
            $table->string('audio')->nullable();
            $table->string('file')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
        });
        //
        Schema::create('listing_as', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sort_order')->nullable();
            $table->timestamps();
        });
        Schema::create('category_facility', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
        });
        //
        Schema::create('facility_property', function (Blueprint $table) {
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->text('value')->nullable(); // Agregar el campo adicional 'value'
        });
        //
        Schema::create('outdoor_property', function (Blueprint $table) {
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->foreignId('outdoor_id')->constrained()->cascadeOnDelete();
            $table->string('distance')->nullable();
        });
        //
        Schema::create('currency_property', function (Blueprint $table) {
            $table->foreignId('currency_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('price')->nullable();
        });
        //
        Schema::create('temporary_files', function (Blueprint $table) {
            $table->id();
            $table->string('folder');
            $table->string('filename');
            $table->string('extension');
            $table->timestamps();
        });
        //
        Schema::create('front_sections', function (Blueprint $table) {
            $table->id();
            $table->string('heading')->nullable();
            $table->string('key')->nullable();
            $table->string('theme')->nullable();
            $table->json('content')->nullable();
            $table->timestamps();
        });
        //
        Schema::create('sectionables', function (Blueprint $table) {
            $table->foreignId('front_section_id')->constrained()->cascadeOnDelete();
            $table->morphs('sectionable');
            $table->string('sort_order')->nullable();

            $table->unique(['front_section_id', 'sectionable_id', 'sectionable_type'], 'unique_assign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('facility_property');
        //
        Schema::dropIfExists('category_facility');
        //
        Schema::dropIfExists('currency_property');
        //
        Schema::dropIfExists('facilities');
        //
        Schema::dropIfExists('user_reports');
        Schema::dropIfExists('report_reasons');
        //
        Schema::dropIfExists('outdoor_property');
        Schema::dropIfExists('outdoors');
        //
        Schema::dropIfExists('payments');
        Schema::dropIfExists('user_purchased_packages');
        Schema::dropIfExists('packages');
        //
        Schema::dropIfExists('contacts');
        //
        Schema::dropIfExists('reviews');
        //
        Schema::dropIfExists('messages');
        //
        Schema::dropIfExists('properties');
        //
        Schema::dropIfExists('listing_as');
        //
        Schema::dropIfExists('temporary_files');
        //
        Schema::dropIfExists('sectionables');
        //
        Schema::dropIfExists('front_sections');
    }
};
