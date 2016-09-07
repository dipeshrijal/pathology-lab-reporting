{!! Form::model($user, ['route' => ['patients.update', $user->id], 'method' => 'put', 'class' => 'form-validate']) !!}

    <div class="modal modal-fixed-footer" id="edit-user{{ $user->id }}">
        <div class="modal-content">

            <h4> Edit Patient </h4>
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons green-text prefix">
                        account_circle
                    </i>
                    {!! Form::text('name', null, ['class' => $errors->has('name') ? 'invalid' : '', 'id' => 'name', 'autofocus', 'required']) !!}
                    <label for="name" data-error="{{ $errors->first('name') }}"> Name <span class="red-text">*</span></label>
                </div>

                <div class="input-field col s12">
                    <i class="material-icons prefix">
                        email
                    </i>
                    {!! Form::email('email', null, ['class' => $errors->has('email') ? 'invalid' : '', 'id' => 'email', 'required']) !!}
                    <label for="email" data-error="{{ $errors->first('email') }}"> Email
                        <span class="red-text">*</span>
                    </label>
                </div>
                <div class="input-field col s12">
                    <i class="material-icons prefix">
                        phone
                    </i>
                    {!! Form::text('phone', null, ['class' => $errors->has('phone') ? 'invalid' : '', 'id' => 'cphone', 'required', 'data-rule-minlength' =>10, 'data-rule-maxlength' =>10, 'data-rule-digits' => true]) !!}
                    <label for="phone" data-error="{{ $errors->first('phone') }}"> Phone
                        <span class="red-text">*</span>
                    </label>
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
