<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->decimal('montant', 8, 2);
            $table->enum('methode', ['especes', 'carte', 'virement'])->default('carte');
            $table->enum('statut', ['en_attente', 'paye', 'rembourse'])->default('en_attente');
            $table->timestamp('date_paiement')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('paiements');
    }
};