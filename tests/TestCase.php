<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    protected $faker;

    protected function setUp() {
        parent::setUp();
        $this->artisan('migrate:refresh');
        $this->artisan('db:seed');
    }

    protected function tearDown() {
        $this->artisan('migrate:refresh');
        $this->artisan('db:seed');
        parent::tearDown();
    }

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function user()
    {
        $user = App\Entities\User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => 1234567899,
        ]);
        $user->assignRole('patient');

        return $user;
    }
}
