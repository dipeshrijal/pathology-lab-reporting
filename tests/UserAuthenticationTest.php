<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserAuthenticationTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function a_user_can_log_in()
    {
        $this->visit(route('login'))
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->assertResponseStatus(200)
            ->seePageIs('/operator/dashboard');
    }

    /**
     * @test
     */
    public function a_user_cannot_log_in_with_invalid_information()
    {
        $this->visit(route('login'))
            ->type('', 'email')
            ->type('', 'password')
            ->press('Login')
            ->see('The email field is required')
            ->see('The password field is required')
            ->seePageIs('/login')
            ->type('operator@example.com', 'email')
            ->type('', 'password')
            ->press('Login')
            ->see('The password field is required')
            ->seePageIs('/login')
            ->type('', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->see('The email field is required')
            ->type('error@errormail.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->see('These credentials do not match our records')
            ->seePageIs('/login');
    }
}
