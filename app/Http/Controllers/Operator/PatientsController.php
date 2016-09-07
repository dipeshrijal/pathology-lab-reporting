<?php

namespace App\Http\Controllers\Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use App\Http\Requests\Operator\PatientRequest;

class PatientsController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $q = $request->q;
        $users = $this->user->fetch($q);

        if ($request->ajax()) {
            return $this->user->filterPatients($request->q);
        }

        return view('operator.patients.index', compact('users', 'q'));
    }

    public function show($id)
    {
        $user = $this->user->find($id);

        return view('operator.patients.show', compact('user'));
    }

    public function store(PatientRequest $request)
    {
        $user = $this->user->create(
            $request->only('name','email','phone')
        );
        $user->assignRole('patient');

        return back()->with('success', 'Patient Created');
    }

    public function update($patient, PatientRequest $request)
    {
        $this->user->update(
            $request->only('name','email','phone'),
            $patient
        );

        return back()->with('success', 'Patient Updated');
    }

    public function destroy($patient)
    {
        $this->user->delete($patient);

        return redirect()->route('patients.index')->with('success', 'Patient Deleted');
    }

    public function sendPasscode($id)
    {
        $user = $this->user->find($id);
        $mail = $this->user->sendPasscode($user);

        if (!$mail->send()) {
            return back()->with('error', $mail->ErrorInfo);
        } else {
            return back()->with('success', 'Mail Successfully Sent');
        }
    }
}
