<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ProcessQueue extends Command
{
    protected $signature = 'queue:process';
    protected $description = 'Process unsent users and mark them as sent';

    public function handle()
    {
        $users = User::where('sent', false)->get();

        foreach ($users as $user) {
            // Фиктивная отправка
            $this->info("Sending to {$user->name} ({$user->phone_number})");

            // Обновляем статус
            $user->update(['sent' => true]);
        }

        $this->info('All messages sent!');
    }
}
