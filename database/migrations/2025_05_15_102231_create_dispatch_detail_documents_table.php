<?php

use App\Models\Dispatch_details;
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
        Schema::create('dispatch_detail_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Dispatch_details::class)->nullable()->constrained();
            $table->string('title')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatch_detail_documents');
    }
};
