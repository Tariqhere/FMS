<?php

use App\Models\Dispatch;
use App\Models\User;
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
        Schema::create('dispatch_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Dispatch::class)->nullable()->constrained();
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->string('remark');
             $table->enum('status', ['submit', 'approve', 'reject', 'return', 'recommend'])->default('submit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatch_details');
    }
};
