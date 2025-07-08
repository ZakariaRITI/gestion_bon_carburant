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
        Schema::disableForeignKeyConstraints();
        Schema::create('bons', function (Blueprint $table) {
            $table->id();
            $table->integer('n_bon')->unique();
            $table->string('type_carburant');
            $table->double('quantite');
            $table->double('prix');
            $table->double('total');
            $table->date('date_bon');
            $table->date('date_saisis');
            $table->foreignId('site_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('service_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('vehicule_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('preneur_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('utilisateur_id')->constrained()->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bons');
    }
};
