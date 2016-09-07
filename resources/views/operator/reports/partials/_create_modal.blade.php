<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    <button class="btn-floating btn-large red modal-trigger" data-target="add-user">
        <i class="large material-icons">
            add
        </i>
    </button>
</div>

{!! Form::open(['route' => 'patients.store', 'class' => 'col s12 form-validate']) !!}

    <div class="modal modal-fixed-footer" id="add-user">
        <div class="modal-content">

            <h4> Create Report </h4>

            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">
                        account_circle
                    </i>
                    {!! Form::text('name', null, ['class' => $errors->has('name') ? 'invalid' : '', 'id' => 'name', 'autofocus', 'required']) !!}
                    <label for="name" data-error="{{ $errors->first('name') }}"> Patient Name <span class="red-text">*</span></label>
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
                    {!! Form::text('phone', null, ['class' => $errors->has('phone') ? 'invalid' : '', 'id' => 'phone', 'required']) !!}
                    <label for="phone" data-error="{{ $errors->first('phone') }}"> Phone
                        <span class="red-text">*</span>
                    </label>
                </div>



            </div>

            {{-- <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons green-text prefix">
                        comment
                    </i>
                    {!! Form::textarea('description', null, ['class' => 'materialize-textarea', 'id' => 'description']) !!}
                    <label for="description">
                        Category Description
                    </label>
                </div>
            </div> --}}
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
