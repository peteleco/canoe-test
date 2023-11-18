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
        Schema::create('company_fund', function (Blueprint $table) {
            $table->id();
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
            $table->unsignedBigInteger('fund_id');
            $table->foreign('fund_id')
                ->references('id')
                ->on('funds')
                ->onDelete('cascade');
            $table->unsignedBigInteger('company_id');
            $table->index(['company_id', 'fund_id']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_fund');
    }
};
