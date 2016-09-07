<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class PatientsTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function can_create_patient()
    {
        $this->visit('/login')
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->seePageIs('/operator/dashboard')
            ->visit('/operator/patients');
        $name     = $this->faker->name;
        $email    = $this->faker->email;
        $phone    = '1234567899';
        $response = $this->route('post', 'patients.store', ['name' => $name, 'email' => $email, 'phone' => $phone]);
        $this->assertRedirectedTo('operator/patients');
        $this->assertEquals(302, $response->status());
        $this->followRedirects();
        $this->see('Patient Created');
        $this->seeInDatabase('users', ['email' => $email], 'sqlite');
    }

    /**
     * @test
     */
    public function an_operator_can_create_patient()
    {
        $this->visit('/login')
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->seePageIs('/operator/dashboard')
            ->visit('/operator/patients')
            ->submitForm('Save', [
                'name' => 'dipesh rijal',
                'email' => 'dipesh.rijal@gmail.com',
                'phone' => 1111111111,
            ]);
        $this->see('Patient Created');
        $this->seeInDatabase('users', ['email' => 'dipesh.rijal@gmail.com'], 'sqlite');
    }

    /**
     * @test
     */
    public function an_operator_cannot_create_patient_with_invalid_information()
    {
        $this->visit('/login')
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->seePageIs('/operator/dashboard')
            ->visit('/operator/patients')
            ->type('', 'email')
            ->type('', 'name')
            ->type('', 'phone')
            ->press('Save')
            ->see('The name field is required')
            ->see('The email field is required')
            ->see('The phone field is required')
            ->type('operator@example.com', 'email')
            ->type('', 'name')
            ->type('', 'phone')
            ->press('Save')
            ->see('The email has already been taken')
            ->see('The name field is required')
            ->see('The phone field is required')
            ->type('abc@example.com', 'email')
            ->type('abc', 'name')
            ->type('www', 'phone')
            ->press('Save')
            ->see('The phone must be 10 digits.')
            ->type('wwweeewwwew', 'phone')
            ->press('Save')
            ->see('The phone must be 10 digits.');
    }

    /** @test */
    public function an_operator_can_edit_patient()
    {
        $user = $this->user();
        $this->seeInDatabase('users', ['email' => $user->email]);
        $this->visit('/login')
            ->submitForm('Login', [
                'email'    => 'operator@example.com',
                'password' => 'secret',
            ])
            ->visit('operator/patients/')
            ->submitForm('Update', [
                'name' => 'dipesh',
            ])
            ->followRedirects();
        $this->seePageIs('/operator/patients')
            ->see('Patient Updated');
        $user = App\Entities\User::find($user->id);
        $this->assertEquals('dipesh', $user->name);
    }

    /**
     * @test
     */
    public function an_operator_can_delete_patient()
    {
        $user = $this->user();
        $this->visit('/login')
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->visit('operator/patients');

        $response = $this->route('delete', 'patients.destroy', [$user->id]);
        $this->assertRedirectedToRoute('patients.index')
            ->assertEquals(302, $response->getStatusCode());
        $this->notSeeInDatabase('users', ['id' => $user->id], 'sqlite');
    }

    /**
     * @test
     */
    public function an_operator_can_view_patients()
    {
        $user = $this->user();
        $this->seeInDatabase('users', ['email' => $user->email]);
        $this->visit('/login')
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->visit('/operator/patients/' . $user->id)
            ->see($user->name)
            ->see($user->email);
    }
}
