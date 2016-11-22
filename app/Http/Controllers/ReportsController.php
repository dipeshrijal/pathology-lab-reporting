<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\ReportRepository;

class ReportsController extends Controller
{
    protected $report;
    protected $user;

    public function __construct(ReportRepository $report, UserRepository $user)
    {
        $this->report = $report;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q       = $request->q;
        $reports = $this->report->fetchPatientReport($q);

        return view('operator.reports.index', compact('reports', 'q'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $report = $this->report->find($id);

        if ($report->patient_id !== auth()->user()->id) {
            return 'u are not allowed';
        }

        return view('operator.reports.show', compact('report'));
    }

    public function download($id)
    {
        $report = $this->report->find($id);
        $pdf = app('dompdf.wrapper');
        $pdf = $pdf->loadView('pdf.report', compact('report'));

        return $pdf->download('report.pdf');
    }

    public function email($id)
    {
        $report = $this->report->find($id);
        $user = $this->user->find($report->patient_id);
        $data = $this->report->email($report, $user);

        if (!$data['mail']->send()) {
            $this->report->deletePDF($data['fileLocation']);
            return back()->with('error', $mail->ErrorInfo);
        } else {
            $this->report->deletePDF($data['fileLocation']);
            return back()->with('success', 'Mail Successfully Sent');
        }
    }
}
