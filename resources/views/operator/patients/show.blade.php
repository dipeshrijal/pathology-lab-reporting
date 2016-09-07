@extends('layouts.operator')
@section('title', 'Show Patients')
@section('content')
<div class="row">
    <div class="col s12 m12">
        <div class="card-panel">
            <div class="card-header-medium cyan darken-2 white-text">
                <div class="row">
                    <div class="col s6">
                        <i class="material-icons valign">
                            account_circle
                        </i>
                        {{ ucfirst($user->name) }}
                    </div>
                    <div class="col s6">
                        <a href="{{ route('patients.index') }}" class="btn-floating cyan darken-3 btn-flat right">
                            <i class="white-text medium material-icons">
                                keyboard_backspace
                            </i>
                        </a>
                    </div>
                    <div class="col s12">
                        <i class="material-icons valign">
                            email
                        </i>
                        {{ $user->email }}
                    </div>
                    <div class="col s12">
                        <i class="material-icons valign">
                            phone
                        </i>
                        {{ $user->phone }}
                    </div>
                </div>
            </div>
            <ul class="center-align" style="margin:-20px 5px 0px 0px">
                <a class="btn-floating blue accent-4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Send Passcode" href="{{ route('patients.sendpasscode', $user->id) }}">
                    <i class="material-icons">
                        mail
                    </i>
                </a>
                <a class="btn-floating green accent-4 modal-trigger hoverable tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="#edit-user{{ $user->id }}">
                    <i class="material-icons">
                        edit
                    </i>
                </a>
                <a class="btn-floating red accent-2 delete-link hoverable">
                    <i class="material-icons tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete">
                        delete_forever
                    </i>
                </a>
                @include('layouts.partials._delete_form', ['route' => ['patients.destroy', $user->id]])
            </ul>
            <div class="row">
                <div class="card-header teal white-text" style="margin-top:10px">
                    <h5>Reports</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s1 offset-s11 index">
                    <span class="green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Good"></span>
                    <span class="amber darken-2 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Bad""></span>
                    <span class="red tooltipped" data-position="bottom" data-delay="50" data-tooltip="Critical"></span>
                </div>
                @forelse ($user->reports as $report)
                    <div class="col s12 m6 l3">
                        <a href="{{ route('reports.show', $report->id) }}">
                            <div class="card-panel {{ status($report->status) }} white-text">
                                <div style="font-size:1.3rem">
                                   <h5> Report Number : #{{ $report->id }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <h5 class="center-align">
                        <p>No Records Found...
                        </p>
                    </h5>

                @endforelse

            </div>
        </div>
    </div>
</div>
@include('operator.patients.partials._edit_modal')
@stop
