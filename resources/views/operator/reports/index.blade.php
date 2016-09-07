@extends('layouts.operator')
@section('title', 'List Reports')
@section('content')

        <div class="card-panel">
            <div class="card-header teal white-text">
                <h5>Reports</h5>
            </div>
            <div class="row">
                <div class="col s1 offset-s11 index" style="margin-top:5px">
                    <span class="green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Good"></span>
                    <span class="amber darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Unsatisfactory""></span>
                    <span class="red tooltipped" data-position="bottom" data-delay="50" data-tooltip="Critical"></span>
                </div>
                @forelse ($reports as $report)
                        <div class="col s12 m4 l3">
                            <div class="card small p-small">
                                @hasrole('operator')
                                    <a href="{{ route('reports.show', $report->id) }}">
                                        <div class="card-header {{ status($report->status) }} white-text">
                                            Report No: #{{ $report->id }}
                                        </div>
                                    </a>

                                    <div class="fixed-action-btn horizontal" style="position:absolute; bottom: 80px; right: 15px;">

                                        <a class="btn-floating teal">
                                            <i class="large material-icons">more_vert</i>
                                        </a>

                                        <ul>

                                            {{-- <a class="btn-floating green accent-4 tooltipped" data-tooltip="Edit" href="{{ route('reports.edit', $report->id) }}">
                                                <i class="material-icons">edit</i>
                                            </a> --}}

                                            <a class="btn-floating green accent-4 modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="#edit-report{{ $report->id }}">
                                                <i class="material-icons">
                                                    edit
                                                </i>
                                            </a>

                                            <a class="btn-floating red accent-2 delete-link tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete">
                                                <i class="material-icons">delete_forever</i>
                                            </a>

                                            @include('layouts.partials._delete_form', ['route' => ['reports.destroy', $report->id]])

                                        </ul>
                                    </div>


                                @else
                                    <a href="{{ route('patients.reports.show', $report->id) }}">
                                        <div class="card-header {{ status($report->status) }} white-text">
                                            Report No: #{{ $report->id }}
                                        </div>
                                    </a>

                                @endrole
                                <div class="card-content">
                                    <h6 class="truncate"><i class="green-text material-icons valign tooltipped" data-position="bottom" data-delay="50" data-tooltip="Patient Name">account_box</i>&nbsp;&nbsp; {{ $report->patient->name }}</h6>
                                    <h6 class="truncate"><i class="green-text material-icons valign tooltipped" data-position="bottom" data-delay="50" data-tooltip="Created Date">today</i>&nbsp;&nbsp; {{ $report->created_at->format('jS F, Y') }}</h6>
                                </div>

                            </div>
                        </div>

                        @include('operator.reports.partials._edit_modal')

                    @empty
                    <h5 class="center-align">No Records Found</h5>
                @endforelse
            </div>

            @role('operator')
                <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
                    <a class="btn-floating btn-large red" href="{{ route('reports.create') }}">
                        <i class="large material-icons">
                            add
                        </i>
                    </a>
                </div>
            @endrole

            <div class="center-align">
                {{ $reports->links() }}
            </div>
        </div>
@stop
