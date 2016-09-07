@extends('layouts.operator', ['searchbar' => true, 'search' => 'Search by name, phone, email', 'q' => $q])
@section('title', 'List Patients')
@section('content')
<div class="card-panel">
    <div class="card-header teal white-text">
        <h5>Patients</h5>
    </div>
    <div class="row">
        @forelse ($users as $user)
        <div class="col s12 m6 l3">
            <div class="card small p-small">
                <a href="{{ route('patients.show', $user->id) }}">
                    <div class="card-header cyan darken-2 white-text">
                        <h5>
                            {{ ucfirst($user->name) }}
                        </h5>
                    </div>
                </a>
                <div class="fixed-action-btn horizontal" style="position:absolute; bottom: 80px; right: 15px;">
                    <a class="btn-floating teal">
                        <i class="large material-icons">
                            more_vert
                        </i>
                    </a>
                    <ul>
                        <a class="btn-floating green accent-4 modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Edit" href="#edit-user{{ $user->id }}">
                            <i class="material-icons">
                                edit
                            </i>
                        </a>
                        <a class="btn-floating red accent-2 delete-link tooltipped" data-position="bottom" data-delay="50" data-tooltip="Delete">
                            <i class="material-icons">
                                delete_forever
                            </i>
                        </a>
                        @include('layouts.partials._delete_form', ['route' => ['patients.destroy', $user->id]])
                    </ul>
                </div>
                <div class="card-content">
                    <h6 class="truncate">
                        <span>
                            <i class="green-text material-icons valign">
                                email
                            </i>
                        </span>
                        &nbsp;&nbsp;{{ $user->email }}
                    </h6>
                    <h6 class="truncate">
                        <span>
                            <i class="green-text material-icons valign">
                                phone
                            </i>
                        </span>
                        &nbsp;&nbsp;{{ $user->phone }}
                    </h6>
                </div>
            </div>
        </div>
        @include('operator.patients.partials._edit_modal')
        @empty
            <h5 class="center-align">No Records Found</h5>
        @endforelse
    </div>

    <div class="center-align">

        {{ $users->links() }}


    </div>
</div>
@include('operator.patients.partials._create_modal')
@stop
