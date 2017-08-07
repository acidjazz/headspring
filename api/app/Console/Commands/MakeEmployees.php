<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;


class MakeEmployees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:employees';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate fake Employees';

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
     * @return mixed
     */
    public function handle()
    {


      $count = $this->ask('How many Employees would you like? ');

      if (!is_numeric($count)) {
        $this->error('Invalid amount');
        return false;
      }
      if ($count > 30000) {
        $this->error('You cannot generate more than 30,000');
        return false;
      }

      $this->info('Truncating Employee Collection');
      Employee::truncate();

      $bar = $this->output->createProgressBar($count);

      $faker = \Faker\Factory::create();


      $this->info('Generating '.$count.' employees');
      for ($i = 0; $i < $count; $i++) {

        $employee = new Employee();
        $employee->firstname = $faker->firstname;
        $employee->lastname = $faker->lastname;
        $employee->name = $employee->firstname . ' ' . $employee->lastname;
        $employee->email = $faker->email;
        $employee->title = $faker->jobTitle;
        $employee->address = [
          'street'=> $faker->streetAddress,
          'city'=> $faker->city,
          'state'=> $faker->stateAbbr,
          'zip'=> $faker->postcode,
        ];

        $employee->active = rand(0,1) === 1;

        $employee->save();
        $bar->advance();

      }

      $bar->finish();

      $this->info("\n".'Employese generated successfully');

      /*
      $employee = [
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'email' => $faker->email,
        'title' => $faker->jobTitle,
        'address' => [
          'street'=> $faker->streetAddress,
          'city'=> $faker->city,
          'state'=> $faker->stateAbbr,
          'zip'=> $faker->postcode,
        ],
      ];

      dd($count, $employee);
      */
    }
}
