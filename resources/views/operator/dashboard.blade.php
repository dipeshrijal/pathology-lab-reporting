@extends('layouts.operator')
@section('title', 'Dashboard')
@section('content')
<div class="card-panel">
        <div class="container">
        <div class="row">
            <a href="{{ route('patients.index') }}">
                <div class="col s12 m4 l3">
                    <div class="card-panel teal">
                        <span class="white-text">
                            Total Patients: {{ count($patients) }}
                        </span>
                    </div>
                </div>
            </a>
            <a href="{{ route('reports.index') }}">
                <div class="col s12 m4 l3">
                    <div class="card-panel teal">
                        <span class="white-text">
                            Total Reports: {{ count($reports) }}
                        </span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@stop
