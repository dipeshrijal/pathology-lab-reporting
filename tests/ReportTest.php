<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReportTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_operator_cannot_create_report_with_invalid_information()
    {
        $user = $this->user();
        $this->visit('/login')
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->seePageIs('/operator/dashboard')
            ->visit('/operator/reports/create')
            ->press('Save')
            ->see('The patient id field is required.')
            ->see('The status field is required.')
            ->see('The test field is required.')
            ->see('The result field is required.')
            ->seePageIs('/operator/reports/create');
    }

    /**
     * @test
     */
    public function an_operator_can_view_report()
    {
        $user = $this->user();

        $data = [
            'patient_id' => $user->id,
            'status'     => 'good',
            'test[0]'    => 'test0',
            'result[0]'  => 'result0',
        ];

        $this->visit('/login')
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->visit('operator/reports');

        $response = $this->route('post', 'reports.store', $data);

        $this->assertRedirectedTo('operator/reports')
            ->assertEquals(302, $response->status());

        $this->visit('operator/reports/1')
            ->see('test0')
            ->see('result0')
            ->see('good');
    }

    /**
     * @test
     */
    public function an_operator_can_delete_report()
    {
        $user = $this->user();

        $data = [
            'patient_id' => $user->id,
            'status'     => 'good',
            'test[0]'    => 'test0',
            'result[0]'  => 'result0',
        ];

        $this->visit('/login')
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->visit('operator/reports');

        $response = $this->route('post', 'reports.store', $data);

        $response = $this->route('delete', 'reports.destroy', [1]);
        $this->assertRedirectedToRoute('reports.index')
            ->assertEquals(302, $response->getStatusCode());
        $this->notSeeInDatabase('reports', ['id' => 1], 'sqlite');
    }

    /**
     * @test
     */
    public function an_operator_can_edit_report()
    {
        $user = $this->user();

        $data = [
            'patient_id' => $user->id,
            'status'     => 'good',
            'test[0]'    => 'test0',
            'result[0]'  => 'result0',
        ];

        $this->visit('/login')
            ->type('operator@example.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->visit('operator/reports');

        $response = $this->route('post', 'reports.store', $data);
        $this->assertRedirectedToRoute('reports.index')
            ->assertEquals(302, $response->getStatusCode());

        $this->visit('operator/reports')
            ->seeInDatabase('reports', ['status' => 'good'])
            ->select('critical', 'status')
            ->press('Update')
            ->see('critical')
            ->seeInDatabase('reports', ['status' => 'critical'])
            ->notSeeInDatabase('reports', ['status' => 'good']);
    }
}
