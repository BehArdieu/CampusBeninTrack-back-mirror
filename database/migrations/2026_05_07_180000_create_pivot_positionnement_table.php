<?php

use App\Enums\PositionnementStatus;
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
        Schema::create('positionnements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonce_id')->constrained();
            $table->foreignId('diaspora_id')->constrained('users');

            $table->text('message')->nullable();
            $table->string('status')->default(PositionnementStatus::EN_ATTENTE->value);

            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->unique(['annonce_id', 'diaspora_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positionnements');
    }
};
