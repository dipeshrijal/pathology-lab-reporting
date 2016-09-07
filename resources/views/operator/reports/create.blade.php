@extends('layouts.operator')
@section('title', 'Create Report')
@section('content')
<div class="row">

    <div class="col s12 m12">
        <div class="card-panel">
            <div class="row">
                <div class="col s12 m8 l8 offset-m2 offset-l2">
                    <div class="row">
                        {!! Form::open(['route' => 'reports.store', 'class' => 'col s12 form-validate']) !!}
                        <div class="row">
                            <div class="col s12">
                                <label for="patient_id">Patient Name <span class="red-text">*</span></label>
                                {!! Form::select('patient_id', [], null, ['class' => $errors->has('patient_id') ? 'invalid' : '', 'id' => 'patient_id', 'placeholer' => 'select patient', 'data-placeholer' => 'select patient', 'data-rule-notinzero' => true, 'autofocus', 'data-error' => ".errorTxt6"]) !!}
                                <div class="input-field">
                                    <div class="errorTxt6"></div>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <table class="test">
                                    <thead>
                                        <tr>
                                            <th>
                                                Test
                                            </th>
                                            <th>
                                                Result
                                            </th>
                                            <th>
                                                Normal Range
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="col s12 input-field">
                                                    <input type="text" name="test[0]" id="test" required />
                                                    <label for="test">
                                                        Test <span class="red-text">*</span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col s12 input-field">
                                                    <input type="text" name="result[0]" id="result" required />
                                                    <label for="result">
                                                        Result <span class="red-text">*</span>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col s12 input-field">
                                                    <input type="text" name="normal_range[0]" id="normal_range" />
                                                    <label for="normal_range">
                                                        Normal Range
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col s12">
                                    <div class="col s3 offset-s9">
                                        <a href="#" class="plusbtn right btn btn-floating green" style="margin-left:5px">
                                            <i class="material-icons white-text">
                                                add
                                            </i>
                                        </a>
                                        <a href="#" class="btn btn-floating minusbtn right red">
                                            <i class="material-icons white-text">
                                                remove
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col s12">
                                <label for="status">Status <span class="red-text">*</span></label>
                                <select data-placeholder="Choose Status" class="error select2-list browser-default" id="status" name="status" required data-error=".errorTxt8">
                                    <option value="" disabled selected>Choose Status</option>
                                    <option value="good">Good</option>
                                    <option value="bad">Unsatisfactory</option>
                                    <option value="critical">Critical</option>
                                </select>
                                <div class="input-field">
                                    <div class="errorTxt8"></div>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                {!! Form::textarea('statement', null, ['class' => 'materialize-textarea', 'id' => 'statement']) !!}
                                {!! Form::label('statement') !!}
                            </div>

                            <div class="col s12">
                                <button class="submit right waves-effect waves-light btn-flat green white-text" type="submit" style="margin-left:20px">
                                    <i class="material-icons white-text right">
                                        send
                                    </i>
                                    Save
                                </button>
                                <a class=" right waves-light waves-red btn-flat white-text red" href="{{ route('reports.index') }}">
                                    Cancel
                                </a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop
    @section('scripts')
    @parent
    <script>
        $('.plusbtn').click(function() {
            var count = 0;
            $('tbody tr').each(function() {
                count++;
            });

            $("tbody").append('<tr> <td> <div class="col s12 input-field"> <input type="text" name="test['+count+']" id="test'+ count +'" required  /> <label for="test'+ count +'">Test <span class="red-text">*</span></label> </div> </td> <td> <div class="col s12 input-field"> <input type="text" name="result['+count+']" id="result'+count+'" required /> <label for="result'+count+'">Result <span class="red-text">*</span></label> </div> </td><td> <div class="col s12 input-field"> <input type="text" name="normal_range['+count+']" id="normal_range'+count+'" /> <label for="normal_range'+count+'">Normal Range</label> </div> </td> </tr>');
        });

        $('.minusbtn').click(function() {
            if($("tbody tr").length != 1) {
                $("tbody tr:last-child").remove();
            } else {
                toastr.options.positionClass = 'toast-top-center';
                toastr.error("You cannot delete first row");
            }
        });
        </script>
    @stop
