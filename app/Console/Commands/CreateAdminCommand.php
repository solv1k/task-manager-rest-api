<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

final class CreateAdminCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'app:create-admin {email} {password}';

    /**
     * @var string
     */
    protected $description = 'Команда для создания нового администратора';

    public function handle(): void
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        if (User::query()->firstWhere('email', $email)) {
            $this->error('Администратор с указанным email уже существует в системе.');

            return;
        }

        $admin = User::factory()->admin()->create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info('Администратор успешно создан.');
        $this->info('email: ' . $email);
        $this->info('password: ' . $password);
        $this->info('bearer: ' . $admin->createToken('auth')->plainTextToken);
    }
}
