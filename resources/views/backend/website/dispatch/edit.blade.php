@extends('backend.layout.auth')
@section('backend')
    <div class="content-wrapper">
        <section class="section ms-4 me-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        {!! html()->form('PUT', route('dispatch.update',$model->id))->attribute('enctype', 'multipart/form-data')->open() !!}
                        <div class="row">
                            <!-- Back Button (Top Right) -->
                            <div class="col-12">
                                <a href="{{ route('dispatch.index') }}" class="btn btn-secondary btn-sm position-absolute top-0 end-0 m-3">
                                    <i class="bi bi-arrow-left"></i> Back
                                </a>
                            </div>

                            <div class="col-12">
                                <div class="form-heading">
                                    <h4>Dispatch Edit</h4>
                                </div>
                            </div>

                            <!-- Title Input -->
                            <div class="col-12 col-md-6">
                                <div class="input-block local-forms">
                                    {!! html()->label('Title <span style="color: red;">*</span>', 'title')->class('form-label') !!}
                                    {!! html()->text('title')->id('title')->class('form-control form-control-sm')->placeholder('Enter Title')->value($model->title) !!}
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Folder Select -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Folders')->class('form-label') !!}
                                    {!! html()->select('folder_id', $folders , $model->folder_id)->class('form-select')->id('folder_id')->placeholder('Select folder')->required() !!}
                                    @error('folder_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Flag Select -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Flag/Folders')->class('form-label') !!}
                                    {!! html()->select('flag_id', $flags , $model->flag_id)->class('form-select')->id('flag_id')->placeholder('Select Flag')->required() !!}
                                    @error('flag_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dispatch Number -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Dispatch Number <span style="color: red;">*</span>', 'dispatch_number')->class('form-label') !!}
                                    {!! html()->text('dispatch_number')->id('dispatch_number')->class('form-control form-control-sm')->placeholder('Enter Dispatch Number')->value($model->dispatch_number) !!}
                                    @error('dispatch_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- File Number -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('File Number <span style="color: red;">*</span>', 'file_number')->class('form-label') !!}
                                    {!! html()->text('file_number')->id('file_number')->class('form-control form-control-sm')->placeholder('Enter File Number')->value($model->file_number) !!}
                                    @error('file_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dispatch Date -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Dispatch date')->class('form-label') !!}
                                    {!! html()->date('dispatch_date')->id('dispatch_date')->class('form-control form-control-sm')->placeholder('Enter dispatch date')->value($model->dispatch_date) !!}
                                    @error('dispatch_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Complete Date -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Complete date')->class('form-label') !!}
                                    {!! html()->date('complete_date')->id('complete_date')->class('form-control form-control-sm')->placeholder('Enter complete date')->value($model->complete_date) !!}
                                    @error('complete_date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Office Selection -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Office(Malibu, Calif.)<span style="color: red;">*</span>', 'office_id')->class('form-label') !!}
                                    {!! html()->select('office_id', $offices , $model->office_id)->class('form-select')->id('office_id')->placeholder('Select Office')->required() !!}
                                    @error('office_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Send To -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Send To<span style="color: red;">*</span>', 'send_to')->class('form-label') !!}
                                    {!! html()->text('send_to')->id('send_to')->class('form-control form-control-sm')->placeholder('Send To')->value($model->send_to) !!}
                                    @error('send_to')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Received From -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Received From <span style="color: red;">*</span>', 'received_from')->class('form-label') !!}
                                    {!! html()->text('received_from')->id('received_from')->class('form-control form-control-sm')->placeholder('Received From')->value($model->received_from) !!}
                                    @error('received_from')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Time Field (New) -->
                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Time<span style="color: red;">*</span>', 'disptach_time')->class('form-label') !!}
                                    {!! html()->time('dispatch_time')->id('dispatch_time')->class('form-control form-control-sm')->placeholder('Select time')->value($model->dispatch_time) !!}
                                    @error('dispatch_time')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- Notepad System (Para/Description with Quill Editor) -->
                            <div class="col-12">
                                <div class="input-block local-forms">
                                    {!! html()->label('Para/Description')->class('form-label') !!}
                                    <div id="editor" style="height: 200px;"></div>
                                    <input type="hidden" name="description" id="description" value="{{$model->description}}">
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 text-start mt-3">
                                {!! html()->submit('Update')->class('btn btn-primary btn-sm')->style('font-size: 12px; padding: 6px 12px;') !!}
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

    <!-- Quill Editor CDN -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Pass all users from PHP to JS -->
    <script>
        const allUsers = @json($users);
    </script>

    <!-- JavaScript for form functionality -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const officeSelect = document.getElementById('office_id');
            const userSelect = document.getElementById('user_id');

            // Office selection handler
            officeSelect.addEventListener('change', function () {
                const selectedOfficeId = this.value;
                userSelect.innerHTML = '';
                const placeholderOption = document.createElement('option');
                placeholderOption.text = 'Select User';
                placeholderOption.disabled = true;
                placeholderOption.selected = true;
                userSelect.appendChild(placeholderOption);

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

            // Initialize Quill Editor
            const quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        ['link', 'blockquote'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['clean']
                    ]
                },
                placeholder: 'Enter description...'
            });

            // Sync Quill content with hidden input for form submission
            const descriptionInput = document.querySelector('#description');
            quill.on('text-change', function() {
                descriptionInput.value = quill.root.innerHTML;
            });

            // Optional: Set initial content (if editing)
            quill.root.innerHTML = descriptionInput.value || '';
        });
    </script>

    <!-- Minimal CSS -->
    <style>
        .ql-editor {
            min-height: 200px;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 14px;
        }
        .ql-toolbar {
            border-radius: 0.25rem 0.25rem 0 0;
        }
        .ql-container {
            border-radius: 0 0 0.25rem 0.25rem;
        }
    </style>
@endsection
