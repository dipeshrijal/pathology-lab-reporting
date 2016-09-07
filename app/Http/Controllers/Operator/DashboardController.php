<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\ReportRepository;
use App\Repositories\Eloquent\UserRepository;

class DashboardController extends Controller
{
    protected $user;
    protected $report;

    public function __construct(UserRepository $user, ReportRepository $report)
    {
        $this->user   = $user;
        $this->report = $report;
    }

    public function index()
    {
        $reports = $this->report->all();
        $patients   = $this->user->patients();

        return view('operator.dashboard', compact('reports', 'patients'));
    }
}
