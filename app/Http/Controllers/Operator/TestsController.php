<?php

namespace App\Http\Controllers\Operator;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Operator\TestRequest;
use App\Repositories\Eloquent\TestRepository;
use App\Repositories\Eloquent\ReportRepository;

class TestsController extends Controller
{
    protected $test;
    protected $report;

    public function __construct(TestRepository $test, ReportRepository $report)
    {
        $this->test = $test;
        $this->report = $report;
    }

    public function store(TestRequest $request)
    {
        $report =  $this->report->find($request->report_id);
        $report->tests()->create($request->only('test', 'result', 'normal_range'));

        return back()->with('success', 'test added');
    }

    public function update(TestRequest $request, $id)
    {
        $this->test->update($request->only('test', 'result', 'normal_range'), $id);

        return back()->with('success', 'test updated');
    }

    public function destroy($id)
    {
        $this->test->delete($id);

        return back()->with('success', 'test deleted');
    }
}
