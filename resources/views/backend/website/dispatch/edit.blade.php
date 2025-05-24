
@extends('backend.layout.auth')
@section('backend')
<div class="content-wrapper">
    <section class="section ms-4 me-4">
        <div class="col-lg-12">
            {!! html()->modelForm($model, 'PUT', route('dispatch.update', $model->id))->attribute('enctype', 'multipart/form-data')->id('dispatch-form')->open() !!}
            <div class="card">
                <div class="card-body">
                    <!-- Back Button (Top Right) -->
                    <div class="col-12">
                        <a href="{{ route('dispatch.index') }}" class="btn btn-secondary btn-sm position-absolute top-0 end-0 m-3">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="col-10">
                        <div class="form-heading">
                            <h4>Dispatch Edit</h4>
                        </div>
                    </div>
            <!-- First Row: Title, Flag -->
                    <div class="row">
                      
                            <!-- First Row: Title, Folder, Flag -->
                            <div class="col-12 col-md-6">
                                <div class="input-block local-forms">
                                    {!! html()->label('Title <span style="color: red;">*</span>', 'title')->class('form-label') !!}
                                    {!! html()->text('title')->id('title')->class('form-control form-control-sm')->placeholder('Enter Title') !!}
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Folders')->class('form-label') !!}
                                    {!! html()->select('folder_id', $flags)->class('form-select')->id('folder_id')->placeholder('Select folder')->required() !!}
                                    @error('folder_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Flag')->class('form-label') !!}
                                    {!! html()->select('flag_id', $flags)->class('form-select')->id('flag_id')->placeholder('Select Flag')->required() !!}
                                    @error('flag_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Second Row: Office, Dispatch Number, File Number -->
                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Office<span style="color: red;">*</span>', 'office_id')->class('form-label') !!}
                                    {!! html()->select('office_id', $offices)->class('form-select')->id('office_id')->placeholder('Select Office')->required() !!}
                                    @error('office_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Dispatch Number <span style="color: red;">*</span>', 'dispatch_number')->class('form-label') !!}
                                    {!! html()->text('dispatch_number')->id('dispatch_number')->class('form-control form-control-sm')->placeholder('Enter Dispatch Number') !!}
                                    @error('dispatch_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('File Number <span style="color: red;">*</span>', 'file_number')->class('form-label') !!}
                                    {!! html()->text('file_number')->id('file_number')->class('form-control form-control-sm')->placeholder('Enter File Number') !!}
                                    @error('file_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Third Row: Received From, Send To, Date, Time, Complete Date -->
                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Received From <span style="color: red;">*</span>', 'received_from')->class('form-label') !!}
                                    {!! html()->text('received_from')->id('received_from')->class('form-control form-control-sm')->placeholder('Received From') !!}
                                    @error('received_from')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Send To<span style="color: red;">*</span>', 'send_to')->class('form-label') !!}
                                    {!! html()->text('send_to')->id('send_to')->class('form-control form-control-sm')->placeholder('Send To') !!}
                                    @error('send_to')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Date')->class('form-label') !!}
                                    {!! html()->date('date')->id('date')->class('form-control form-control-sm')->placeholder('Enter date') !!}
                                    @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Time<span style="color: red;">*</span>', 'dispatch_time')->class('form-label') !!}
                                    {!! html()->time('dispatch_time')->id('dispatch_time')->class('form-control form-control-sm')->placeholder('Select time') !!}
                                    @error('dispatch_time')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Row: Description -->
                            <div class="col-12">
                                <div class="input-block local-forms">
                                    {!! html()->label('Para/Description')->class('form-label') !!}
                                    <div id="editor" class="quill-editor"></div>
                                    <input type="hidden" name="description" id="description">
                                    @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Separate Attachments Card -->
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Attachments</h5>
                                        <div id="attachment-container" class="row">
                                            <div class="col-12 col-md-10 mb-2 attachment-row" data-attachment-id="0">
                                                <p class="mb-2">Input Document Attachment</p>
                                                <div class="input-group flex-grow-1 me-2 position-relative">
                                                    <input type="file" name="attachments[0][]" id="attachment-0" class="form-control form-control-sm attachment-input d-none" accept="image/jpeg,image/png,application/pdf" multiple>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm choose-file-btn">Choose File</button>
                                                    <span id="attachment-text-0" class="form-control form-control-sm border-0" style="margin-left: 10px">No file chosen</span>
                                                    <button type="button" class="btn btn-outline-danger btn-sm remove-attachment-row d-none" data-attachment-id="0">Remove</button>
                                                </div>
                                                <div id="attachment-preview-0" class="mt-2 preview-container col-12" style="display: none;"></div>
                                                @error('attachments.*')
                                                <span class="text-danger ml-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-2 d-flex flex-column align-items-start justify-content-center">
                                                <div class="col-12">
                                                    <button type="button" id="add-attachment" class="btn btn-success btn-sm">Add more</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Separate Users Table Card -->
                            <div class="col-12 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Users List</h5>
                                        <div class="input-group mb-3" style="max-width: 300px;">
                                            <input type="text" id="user-search" class="form-control form-control-sm" placeholder="Search by name..." aria-label="Search users">
                                        </div>
                                        <div id="user-container">
                                            <table class="table table-striped" id="user-table" style="display: none;">
                                                <thead>
                                                    <tr>
                                                        <th>S#</th>
                                                        <th>Name</th>
                                                        <th>Cnic_No</th>
                                                        <th>Email</th>
                                                        <th>Contact_NO</th>
                                                        <th>All<input type="checkbox" id="select-all"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="user-table-body"></tbody>
                                            </table>
                                        </div>
                                    </div>
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
        const userContainer = document.getElementById('user-container');
        const userTable = document.getElementById('user-table');
        const userTableBody = document.getElementById('user-table-body');
        const attachmentContainer = document.getElementById('attachment-container');
        const userSearch = document.getElementById('user-search');
        const selectAllCheckbox = document.getElementById('select-all');

        let currentFilteredUsers = [];
        let attachmentCount = 0;

        // Office selection handler
        officeSelect.addEventListener('change', function () {
            const selectedOfficeId = this.value;
            userTableBody.innerHTML = ''; // Clear previous rows
            userTable.style.display = 'none'; // Hide table until users are loaded
            selectAllCheckbox.checked = false; // Reset select all checkbox

            currentFilteredUsers = allUsers.filter(user => user.office_id == selectedOfficeId);
            updateUserTable(currentFilteredUsers);
        });

        // Search handler
        userSearch.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const filtered = currentFilteredUsers.filter(user =>
                user.name.toLowerCase().includes(searchTerm)
            );
            updateUserTable(filtered);
        });

        // Select all handler
        selectAllCheckbox.addEventListener('change', function () {
            const checkboxes = userTableBody.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Function to update user table
        function updateUserTable(users) {
            userTableBody.innerHTML = '';
            if (users.length > 0) {
                users.forEach((user, index) => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${user.name || ''}</td>
                        <td>${user.cnic || ''}</td>
                        <td>${user.email || ''}</td>
                        <td>${user.contact || ''}</td>
                        <td><input type="checkbox" name="selected_users[]" value="${user.id}"></td>`;
                    userTableBody.appendChild(row);
                });
                userTable.style.display = 'table'; // Show table
            } else {
                const row = document.createElement('tr');
                row.innerHTML = '<td colspan="6">No users found</td>';
                userTableBody.appendChild(row);
                userTable.style.display = 'table'; // Show table with message
            }
        }

        // Function to add new attachment frame
        function addAttachmentFrame() {
            attachmentCount++;
            const newAttachment = document.createElement('div');
            newAttachment.className = 'col-12 col-md-10 mb-2 attachment-row';
            newAttachment.setAttribute('data-attachment-id', attachmentCount);
            newAttachment.innerHTML = `
                <p class="mb-2">Input Document Attachment</p>
                <div class="input-group flex-grow-1 me-2 position-relative">
                    <input type="file" name="attachments[${attachmentCount}][]" id="attachment-${attachmentCount}" class="form-control form-control-sm attachment-input d-none" accept="image/jpeg,image/png,application/pdf" multiple>
                    <button type="button" class="btn btn-outline-secondary btn-sm choose-file-btn">Choose File</button>
                    <span id="attachment-text-${attachmentCount}" class="form-control form-control-sm border-0" style="margin-left: 10px">No file chosen</span>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-attachment-row" data-attachment-id="${attachmentCount}">Remove</button>
                </div>
                <div id="attachment-preview-${attachmentCount}" class="mt-2 preview-container col-12" style="display: none;"></div>
                @error('attachments.*')
                    <span class="text-danger ml-2">{{ $message }}</span>
                @enderror`;

            attachmentContainer.insertBefore(newAttachment, attachmentContainer.querySelector('.col-md-2'));

            // Initialize the new attachment input
            const newInput = document.getElementById(`attachment-${attachmentCount}`);
            const newText = document.getElementById(`attachment-text-${attachmentCount}`);
            const newPreview = document.getElementById(`attachment-preview-${attachmentCount}`);
            const newChooseBtn = newInput.closest('.input-group').querySelector('.choose-file-btn');
            const newRemoveBtn = newAttachment.querySelector('.remove-attachment-row');
            newChooseBtn.addEventListener('click', () => newInput.click());
            newInput.addEventListener('change', () => handleFileSelect(newInput, newText, newPreview));
            newRemoveBtn.addEventListener('click', () => removeAttachmentRow(attachmentCount));
        }

        // Function to remove an attachment row
        function removeAttachmentRow(attachmentId) {
            if (attachmentId === '0') return; // Prevent removing the first attachment
            const rowToRemove = attachmentContainer.querySelector(`.attachment-row[data-attachment-id="${attachmentId}"]`);
            if (rowToRemove) {
                rowToRemove.remove();
            }
        }

        // Add attachment handler
        document.getElementById('add-attachment').addEventListener('click', addAttachmentFrame);

        // Initial attachment input handler
        const initialInput = document.getElementById('attachment-0');
        const initialText = document.getElementById('attachment-text-0');
        const initialPreview = document.getElementById('attachment-preview-0');
        const initialChooseBtn = initialInput.closest('.input-group').querySelector('.choose-file-btn');
        const initialRemoveBtn = initialInput.closest('.input-group').querySelector('.remove-attachment-row');
        initialChooseBtn.addEventListener('click', () => initialInput.click());
        initialInput.addEventListener('change', () => handleFileSelect(initialInput, initialText, initialPreview));
        if (initialRemoveBtn) {
            initialRemoveBtn.addEventListener('click', () => removeAttachmentRow('0'));
        }

        // Handle file selection and preview
        function handleFileSelect(input, textSpan, previewDiv) {
            const files = input.files;
            previewDiv.innerHTML = '';
            if (files.length > 0) {
                textSpan.textContent = `${files.length} file(s) selected`;
                previewDiv.style.display = 'block';

                Array.from(files).forEach((file, index) => {
                    const fileContainer = document.createElement('div');
                    fileContainer.className = 'file-container d-flex align-items-center mb-2';
                    fileContainer.setAttribute('data-index', index);

                    const fileDisplay = document.createElement('div');
                    fileDisplay.className = 'file-display me-2';

                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.style.maxWidth = '100px';
                            img.style.height = 'auto';
                            fileDisplay.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        const fileName = document.createElement('p');
                        fileName.textContent = file.name;
                        fileDisplay.appendChild(fileName);
                    }

                    const removeBtn = document.createElement('button');
                    removeBtn.type = 'button';
                    removeBtn.className = 'btn btn-outline-danger btn-sm me-1 remove-file';
                    removeBtn.textContent = 'Remove';
                    removeBtn.addEventListener('click', () => removeFile(input, previewDiv, index));

                    const replaceBtn = document.createElement('button');
                    replaceBtn.type = 'button';
                    replaceBtn.className = 'btn btn-outline-primary btn-sm replace-file';
                    removeBtn.textContent = 'Replace';
                    replaceBtn.addEventListener('click', () => replaceFile(input, index));

                    fileContainer.appendChild(fileDisplay);
                    fileContainer.appendChild(removeBtn);
                    fileContainer.appendChild(replaceBtn);
                    previewDiv.appendChild(fileContainer);
                });
            } else {
                textSpan.textContent = 'No file chosen';
                previewDiv.style.display = 'none';
            }
        }

        // Remove a specific file
        function removeFile(input, previewDiv, indexToRemove) {
            const files = Array.from(input.files);
            const newFiles = files.filter((_, idx) => idx !== indexToRemove);

            const dataTransfer = new DataTransfer();
            newFiles.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;

            handleFileSelect(input, input.closest('.input-group').querySelector('span'), previewDiv);
        }

        // Replace a specific file
        function replaceFile(input, indexToReplace) {
            const tempInput = document.createElement('input');
            tempInput.type = 'file';
            tempInput.accept = 'image/jpeg,image/png,application/pdf';
            tempInput.multiple = false;
            tempInput.style.display = 'none';
            document.body.appendChild(tempInput);

            tempInput.addEventListener('change', () => {
                if (tempInput.files.length > 0) {
                    const files = Array.from(input.files);
                    const newFile = tempInput.files[0];
                    files[indexToRemove] = newFile;

                    const dataTransfer = new DataTransfer();
                    files.forEach(file => dataTransfer.items.add(file));
                    input.files = dataTransfer.files;

                    handleFileSelect(input, input.closest('.input-group').querySelector('span'), input.closest('.input-group').nextElementSibling);
                }
                document.body.removeChild(tempInput);
            });

            tempInput.click();
        }

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
    .content-wrapper {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        padding: 15px;
    }
    .section {
        width: 100%;
        max-width: 100%;
    }
    .card {
        width: 100%;
        max-width: 100%;
    }
    .input-block.local-forms {
        margin-bottom: 1rem;
    }
    .form-label {
        font-weight: 500;
        font-size: 0.875rem;
    }
    .form-control-sm, .form-select {
        font-size: 0.875rem;
    }
    .text-danger {
        font-size: 0.8rem;
    }
    .card-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    .quill-editor {
        min-height: 200px;
        width: 100%;
    }
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
    .input-group .form-control.border-0 {
        background: transparent;
        color: #6c757d;
        font-size: 0.875rem;
        padding: 0.375rem 0;
    }
    .choose-file-btn, .remove-file, .replace-file, #add-attachment, .remove-attachment-row {
        padding: 6px 12px;
        font-size: 0.875rem;
    }
    .attachment-row {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 0.25rem;
    }
    .preview-container {
        background: #f8f9fa;
        padding: 5px;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }
    .preview-container .file-container {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 5px;
    }
    .preview-container .file-container:last-child {
        border-bottom: none;
    }
    .preview-container img {
        margin: 2px 0;
        max-width: 100%;
    }
    table.table-striped {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        display: block;
    }
    table.table-striped th,
    table.table-striped td {
        padding: 8px;
        text-align: left;
        white-space: nowrap;
    }
    #user-search {
        margin-bottom: 10px;
    }
    @media (max-width: 767px) {
        .form-control-sm, .form-select {
            font-size: 0.75rem;
        }
        .btn-sm {
            font-size: 0.75rem;
            padding: 4px 8px;
        }
        .card-body {
            padding: 10px;
        }
        .attachment-row {
            padding: 0.15rem;
        }
        .choose-file-btn, .remove-file, .replace-file, #add-attachment, .remove-attachment-row {
            padding: 4px 8px;
            font-size: 0.75rem;
        }
    }
</style>
@endsection
