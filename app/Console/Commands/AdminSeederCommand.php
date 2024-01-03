<?php

namespace App\Console\Commands;

use Database\Seeders\AdminSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AdminSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin-credentials:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database with admin credentials';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Enter your Name');
        while (!$name) {
            $name = $this->ask('Please enter your Name');
        }

        $email = $this->askForEmail('Enter your Email');
        $password = $this->askForPassword('Enter your Password');

        $seederClass = App::make(AdminSeeder::class);
        $seederClass->run($name, $email, $password);

        $this->info('Admin created successfully');
    }

    private function askForEmail($prompt)
    {
        $validator = Validator::make(['email' => null], [
            'email' => 'required|email',
        ]);

        $email = '';
        while (true) { // Using while(true) to ensure the loop continues until we explicitly break out of it
            $email = $this->ask($prompt);

            if (!$email) {
                $this->error('Please enter your Email');
                continue;
            }

            $validator->setData(['email' => $email]);

            if ($validator->fails()) {
                $this->error($validator->errors()->first('email'));
                continue;
            }

            if (User::where('email', $email)->exists()) {
                $this->error('Email already exists. Please enter a different Email.');
                continue;
            }

            break; // If the email passes both checks, exit the loop
        }

        return $email;
    }

    
    private function askForPassword($prompt)
    {
        $password = $this->secret($prompt);

        while (!$password) {
            $password = $this->secret('Please enter your Password');
        }

        return $password;
    }
}