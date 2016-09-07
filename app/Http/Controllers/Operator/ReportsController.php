<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Operator\ReportRequest;
use App\Repositories\Eloquent\ReportRepository;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    protected $report;
    protected $user;

    public function __construct(ReportRepository $report, UserRepository $user)
    {
        $this->report = $report;
        $this->user   = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q       = $request->q;
        $reports = $this->report->fetch($q);

        return view('operator.reports.index', compact('reports', 'q'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = $this->user->patients();

        return view('operator.reports.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportRequest $request)
    {
        $report = $this->user->find($request->patient_id)->reports()->create($request->only('statement', 'status'));

        for ($i=0; $i < count($request->test); $i++) {
            $testResults = [];
            $testResults['test'] = $request->test[$i];
            $testResults['result'] = $request->result[$i];
            $testResults['normal_range'] = isset($request->normal_range[$i]) ? $request->normal_range[$i] : null;

            $report->tests()->create($testResults);
        }

        return redirect()->route('reports.index')->with('success', 'Report Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = $this->report->find($id);

        return view('operator.reports.show', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request    $request
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportRequest $request, $report_id)
    {
        $this->report
            ->update(
                $request->only('statement', 'status'),
                $report_id
            );

        return back()->with('success', 'Report Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int                         $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($report_id)
    {
        $this->report->delete($report_id);

        return redirect()->route('reports.index')->with('success', 'Report Deleted');
    }
}
