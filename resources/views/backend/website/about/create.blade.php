@extends('backend.layout.auth')
@section('backend')
<div class="content-wrapper">
    <section class="section ms-4 me-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {!! html()->form('POST', route('dispatch.store'))->attribute('enctype', 'multipart/form-data')->open() !!}
                    <div class="row">
                        <!-- Back Button (Top Right) -->
                        <div class="col-12">
                            <a href="{{ route('dispatch.index') }}" class="btn btn-secondary btn-sm position-absolute top-0 end-0 m-3">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                        </div>

                        <div class="col-12">
                            <div class="form-heading">
                                <h4>Dispatch Create</h4>
                            </div>
                        </div>

                        <!-- Title Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Title')->class('form-label') !!}
                                {!! html()->text('title')->id('title')->class('form-control form-control-sm')->placeholder('Enter Title') !!}
                            </div>
                        </div>

                        <!-- Description Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Description')->class('form-label') !!}
                                {!! html()->text('description')->id('description')->class('form-control form-control-sm')->placeholder('Enter Contact description') !!}
                            </div>
                        </div>

                        <!-- Remark Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Remark')->class('form-label') !!}
                                {!! html()->text('remark')->id('remark')->class('form-control form-control-sm')->placeholder('Enter Remark') !!}
                            </div>
                        </div>

                        <!-- Attachment Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Attachments')->class('form-label') !!}
                                {!! html()->file('attachment[]')
                                        ->id('attachment')
                                        ->class('form-control form-control-sm')
                                        ->attribute('multiple', true) !!}
                                <small class="text-muted">You can select multiple files</small>
                                @error('attachment') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <!-- Dispatch Date -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Dispatch date')->class('form-label') !!}
                                {!! html()->date('dispatch_date')->id('dispatch_date')->class('form-control form-control-sm')->placeholder('Enter dispatch date') !!}
                            </div>
                        </div>

                        <!-- Flag Select -->
                        <div class="col-12 col-md-6 ">
                            <div class="input-block local-forms">
                                {!! html()->label('Flag')->class('form-label') !!}
                                {!! html()->select('flag_id', $flags)->class('form-select')->id('flag_id')->placeholder('Select Flag')->required() !!}
                                @error('flag_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Complete Date -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Complete date')->class('form-label') !!}
                                {!! html()->date('created_at')->id('complete_date')->class('form-control form-control-sm')->placeholder('Enter complete date') !!}
                            </div>
                        </div>

                        <!-- Office Selection -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Office')->class('form-label') !!}
                                {!! html()->select('office_id', $offices)->class('form-select')->id('office_id')->placeholder('Select Office')->required() !!}
                                @error('office_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- User Selection -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('User')->class('form-label') !!}
                                {!! html()->select('user_id', [])->class('form-select')->id('user_id')->placeholder('Select User')->required() !!}
                                @error('user_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                


                        <!-- Submit Button -->
                        <div class="col-12 text-start mt-3">
                            {!! html()->submit('Submit')->class('btn btn-primary btn-sm')->style('font-size: 12px; padding: 6px 12px;') !!}
                        </div>
                    </div>
                    {!! html()->form()->close() !!}
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Pass all users from PHP to JS -->
<script>
    const allUsers = @json($users);
</script>

<!-- Filter users by selected office -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const officeSelect = document.getElementById('office_id');
        const userSelect = document.getElementById('user_id');

        officeSelect.addEventListener('change', function () {
            const selectedOfficeId = this.value;

            // Clear existing options
            userSelect.innerHTML = '';

            // Add default placeholder
            const placeholderOption = document.createElement('option');
            placeholderOption.text = 'Select User';
            placeholderOption.disabled = true;
            placeholderOption.selected = true;
            userSelect.appendChild(placeholderOption);

            // Filter and append users with matching office_id
            const filteredUsers = allUsers.filter(user => user.office_id == selectedOfficeId);

            if (filteredUsers.length > 0) {
                filteredUsers.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    userSelect.appendChild(option);
                });
            } else {
                const noUserOption = document.createElement('option');
                noUserOption.text = 'No users found';
                noUserOption.disabled = true;
                userSelect.appendChild(noUserOption);
            }
        });
    });
</script>
@endsection
