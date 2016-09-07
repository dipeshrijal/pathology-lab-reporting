@extends('layouts.operator')
@section('title', 'Show Report')
@section('content')
<div class="row">
    <div class="col s12 m12">
        <div class="card-panel">
            <div class="card-header-medium {{ status($report->status) }} white-text">
                <div class="row">
                    <div class="col s6">
                        <i class="material-icons valign">
                            account_box
                        </i>
                        {{ ucfirst($report->patient->name) }}
                    </div>
                    <div class="col s6">
                        @role('operator')
                            <a href="{{ route('reports.index') }}" class="btn-floating {{ status($report->status) }} btn-flat right">
                                <i class="white-text medium material-icons">
                                    keyboard_backspace
                                </i>
                            </a>
                        @else
                            <a href="{{ route('patients.reports.index') }}" class="btn-floating {{ status($report->status) }} btn-flat right">
                                <i class="white-text medium material-icons">
                                    keyboard_backspace
                                </i>
                            </a>
                        @endrole
                    </div>
                    <div class="col s12">
                        <i class="material-icons valign">
                            email
                        </i>
                        {{ $report->patient->email }}
                    </div>
                    <div class="col s12">
                        <i class="material-icons valign">
                            phone
                        </i>
                        {{ $report->patient->phone }}
                    </div>
                </div>
            </div>

            @role('operator')
                <ul class="center-align" style="margin:-20px 5px 0px 0px">
                    <a class="btn-floating green accent-4 modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="#edit-report{{ $report->id }}">
                        <i class="material-icons">
                            edit
                        </i>
                    </a>
                    <a class="btn-floating red accent-2 delete-link hoverable tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete">
                        <i class="material-icons">
                            delete_forever
                        </i>
                    </a>
                    @include('layouts.partials._delete_form', ['route' => ['reports.destroy', $report->id]])
                </ul>
                @include('operator.reports.partials._edit_modal')
            @else
                <ul class="center-align" style="margin:-20px 5px 0px 0px">
                    <a class="btn-floating green accent-4 hoverable tooltipped" data-position="bottom" data-delay="50" data-tooltip="Download as PDF" href="{{ route('patients.reports.download', $report->id) }}">
                        <i class="material-icons">
                            file_download
                        </i>
                    </a>
                    <a class="btn-floating blue accent-4 hoverable tooltipped" data-position="bottom" data-delay="50" data-tooltip="Email as PDF" href="{{ route('patients.reports.email', $report->id) }}">
                        <i class="material-icons">
                            email
                        </i>
                    </a>
                </ul>
            @endrole

            <div class="card-header teal">
                <div class="row">
                    <div class="col s6 white-text">
                        <h5>Report Number : #{{ $report->id }}</h5>
                    </div>
                    @role('operator')
                        <div class="col s6">
                            <span class="right">
                                @include('operator.tests.partials._create_modal')
                            </span>
                        </div>
                    @endrole
                </div>
            </div>

            <table class="bordered centered highlight">
                    <thead>
                      <tr>
                          <th>Test</th>
                          <th>Results</th>
                          <th>Normal Range</th>
                          @role('operator')
                            <th class="right">Actions</th>
                          @endrole
                      </tr>
                    </thead>

                    <tbody>
                        @foreach($report->tests as $test)
                            <tr>
                              <td>{{ $test->test }}</td>
                              <td>{{ $test->result }}</td>
                              <td>{{ $test->normal_range or '--' }}</td>
                              @role('operator')
                                <td class="right">
                                      <a class="btn-floating green accent-4 modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="#edit-test{{ $test->id }}">
                                          <i class="material-icons">
                                              edit
                                          </i>
                                      </a>
                                    <a class="btn-floating red accent-2 delete-link tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete">
                                        <i class="material-icons">
                                            delete_forever
                                        </i>
                                    </a>
                                    @include('layouts.partials._delete_form', ['route' => ['tests.destroy', $test->id]])
                                </td>
                              @endrole

                            </tr>
                            @include('operator.tests.partials._edit_modal')
                        @endforeach
                    </tbody>
                  </table>

                <div class="statement">
                    <p><i class="material-icons green-text valign">comment</i> Statement</p>
                    <p>
                        {{ $report->statement }}
                    </p>
                </div>
        </div>
    </div>
</div>
@stop