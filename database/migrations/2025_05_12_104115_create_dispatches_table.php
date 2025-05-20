
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

             $table->foreignIdFor(User::class)->nullable()->constrained();
             $table->foreignIdFor(Office::class)->nullable()->constrained();
             $table->foreignIdFor(Flag::class)->nullable()->constrained();
             $table->string('title');
             $table->string('description')->nullable();
             $table->string('remark')->nullable();
             $table->json('attachments')->nullable();
             $table->string('dispatch_date')->nullable();
             $table->string('complete_date')->nullable();
             $table->unsignedTinyInteger('status')->default(0);

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
