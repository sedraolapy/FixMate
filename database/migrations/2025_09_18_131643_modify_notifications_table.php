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
        Schema::table('notifications', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn(['type', 'notifiable_type', 'notifiable_id', 'data', 'read_at']);

            $table->string('title')->after('id');
            $table->text('body')->after('title');
            $table->enum('send_to', ['all', 'specific'])->after('body');
            $table->boolean('auto_notification')->default(0);
            $table->date('date')->after('send_to');
            $table->time('time')->after('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn(['title', 'body', 'send_to', 'date', 'time']);
            $table->string('type');
            $table->morphs('notifiable');
            $table->text('data');
        });
    }
};
