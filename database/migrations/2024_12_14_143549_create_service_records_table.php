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
        Schema::create('service_records', function (Blueprint $table) {
            $table->id();
            $table->date('service_date'); // To track services per day
            $table->decimal('extra_fees', 8, 2)->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('barber_id')->constrained()->onDelete('cascade'); // Links to barbers
            $table->foreignId('service_id')->constrained()->onDelete('cascade'); // Links to services
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_records');
    }
};
