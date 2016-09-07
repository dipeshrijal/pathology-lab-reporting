{!! Form::model($report, ['route' => ['reports.update', $report->id], 'method' => 'put', 'class' => 'form-validate']) !!}

    <div class="modal modal-fixed-footer" id="edit-report{{ $report->id }}">
        <div class="modal-content">

            <h4> Edit Report </h4>

            <div class="row">
                <div class="col s12">
                    <label for="status">Status <span class="red-text">*</span></label>
                    <select data-placeholder="Choose Status" class="error select2-list browser-default" id="status" name="status" required data-error=".errorTxt8">
                        @foreach (getstatusList() as $key => $status)
                            <option value="{{ $key }}" {{ $report->status == $key ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                    <div class="input-field">
                        <div class="errorTxt8"></div>
                    </div>
                </div>
                <div class="input-field col s12">
                    {!! Form::textarea('statement', null, ['class' => 'materialize-textarea', 'id' => 'statement']) !!}
                    {!! Form::label('statement') !!}
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="waves-effect waves-light btn-flat green white-text submit" type="submit" style="margin-left:20px">
                <i class="material-icons white-text right">
                    send
                </i>
                Update
            </button>

            <button class="modal-action modal-close waves-light waves-red btn-flat white-text red" type="button">
                Cancel
            </button>
        </div>
    </div>

{!! Form::close() !!}
