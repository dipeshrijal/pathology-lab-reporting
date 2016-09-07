<button class="btn-floating modal-trigger tooltipped" data-target="add-test" data-position="bottom" data-delay="50" data-tooltip="Add Test to Report">
    <i class="material-icons">
        add
    </i>
</button>

{!! Form::open(['route' => 'tests.store', 'class' => 'col s12 form-validate']) !!}

    <div class="modal modal-fixed-footer" id="add-test">
        <div class="modal-content">
            <h4> Create Test </h4>
            <div class="row">
                <input type="hidden" name="report_id" value="{{ $report->id }}">
                <div class="input-field col s12">
                    {!! Form::text('test', null, ['class' => $errors->has('test') ? 'invalid' : '', 'id' => 'test', 'autofocus', 'required']) !!}
                    <label for="test" data-error="{{ $errors->first('test') }}"> Test <span class="red-text">*</span></label>
                </div>
                <div class="input-field col s12">
                    {!! Form::text('result', null, ['class' => $errors->has('result') ? 'invalid' : '', 'id' => 'result', 'required']) !!}
                    <label for="result" data-error="{{ $errors->first('result') }}"> Result <span class="red-text">*</span></label>
                </div>

                <div class="input-field col s12">
                    {!! Form::text('normal_range', null, ['class' => $errors->has('normal_range') ? 'invalid' : '', 'id' => 'normal_range']) !!}
                    <label for="normal_range" data-error="{{ $errors->first('normal_range') }}"> Normal Range
                    </label>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <button class="waves-effect waves-light btn-flat green white-text" type="submit" style="margin-left:20px">
                <i class="material-icons white-text right">
                    send
                </i>
                Save
            </button>

            <button class="modal-action modal-close waves-light waves-red btn-flat white-text red" type="button">
                Cancel
            </button>
        </div>
    </div>

{!! Form::close() !!}
