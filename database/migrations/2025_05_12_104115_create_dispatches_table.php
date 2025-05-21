
<?php

 use App\Models\Flag;
 use App\Models\Office;
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
         Schema::create('dispatches', function (Blueprint $table) {
             $table->id();
             $table->foreignIdFor(Office::class)->nullable()->constrained();
             $table->foreignIdFor(Flag::class)->nullable()->constrained();
             $table->string('title');
             $table->string('dispatch_number')->nullable();
             $table->string('file_number')->nullable();
             $table->string('description')->nullable();
             $table->date('dispatch_date')->nullable(); // Changed from string to date
             $table->date('complete_date')->nullable(); // Changed from string to date
             $table->time('dispatch_time')->nullable();
             $table->timestamps();
         });
     }
     /**
      * Reverse the migrations.
      */
     public function down(): void
     {
         Schema::dropIfExists('dispatches');
    }
 };
