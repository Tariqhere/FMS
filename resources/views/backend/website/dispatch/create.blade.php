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

                        <div class="col-10">
                            <div class="form-heading">
                                <h4>Dispatch Create</h4>
                            </div>
                        </div>

                        <!-- Title Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Title')->class('form-label') !!}
                                {!! html()->text('title')->id('title')->class('form-control form-control-sm')->placeholder('Enter Title')->required() !!}
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Description Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Description')->class('form-label') !!}
                                {!! html()->textarea('description')->id('description')->class('form-control form-control-sm')->placeholder('Enter Description') !!}
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Remark Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Remark')->class('form-label') !!}
                                {!! html()->text('remark')->id('remark')->class('form-control form-control-sm')->placeholder('Enter Remark') !!}
                                @error('remark')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Complete Date -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Complete Date')->class('form-label') !!}
                                {!! html()->date('complete_date')->id('complete_date')->class('form-control form-control-sm')->value(date('Y-m-d'))->required() !!}
                                @error('complete_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Dispatch Date -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Dispatch Date')->class('form-label') !!}
                                {!! html()->date('dispatch_date')->id('dispatch_date')->class('form-control form-control-sm')->value(date('Y-m-d'))->required() !!}
                                @error('dispatch_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Flag Select -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Flag/Folders')->class('form-label') !!}
                                {!! html()->select('flag_id', $flags)->class('form-select form-select-sm')->id('flag_id')->placeholder('Select Flag')->required() !!}
                                @error('flag_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Office Selection -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Office')->class('form-label') !!}
                                {!! html()->select('office_id', $offices)->class('form-select form-select-sm')->id('office_id')->placeholder('Select Office')->required() !!}
                                @error('office_id')
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

            <!-- Separate Attachments Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <div class="col-12">
                        <h5 class="card-title">Attachments</h5>
                        <div id="attachment-container" class="row">
                            <div class="col-10 mb-2 attachment-row">
                                <p class="mb-2">Input Document Attachment</p>
                                <div class="input-group flex-grow-1 me-2 position-relative">
                                    <input type="file" name="attachments[0][]" id="attachment-0" class="form-control form-control-sm attachment-input d-none" accept="image/jpeg,image/png,application/pdf" multiple>
                                    <button type="button" class="btn btn-outline-secondary btn-sm choose-file-btn">Choose File</button>
                                    <span id="attachment-text-0" class="form-control form-control-sm border-0" style="margin-left: 10px">No file chosen</span>
                                </div>
                                <div id="attachment-preview-0" class="mt-2 preview-container col-12" style="display: none;"></div>
                                @error('attachments.*')
                                    <span class="text-danger ml-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-2 d-flex flex-column align-items-start justify-content-center">
                                <p class="mb-2 h5">Action</p>
                                <div class="col-12">
                                    <button type="button" id="add-attachment" class="btn btn-success btn-sm">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Separate Users Table Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <div class="col-12">
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
        </div>
    </section>
</div>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Pass all users from PHP to JS -->
<script>
    const allUsers = @json($users);
</script>

<!-- Filter users by selected office and handle users, search, and attachments -->
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
        let attachmentCount = 0;
        function addAttachmentFrame() {
            attachmentCount++;
            const newAttachment = document.createElement('div');
            newAttachment.className = 'col-10 mb-2 attachment-row';
            newAttachment.innerHTML = `
                <p class="mb-2">Input Document Attachment</p>
                <div class="input-group flex-grow-1 me-2 position-relative">
                    <input type="file" name="attachments[${attachmentCount}][]" id="attachment-${attachmentCount}" class="form-control form-control-sm attachment-input d-none" accept="image/jpeg,image/png,application/pdf" multiple>
                    <button type="button" class="btn btn-outline-secondary btn-sm choose-file-btn">Choose File</button>
                    <span id="attachment-text-${attachmentCount}" class="form-control form-control-sm border-0" style="margin-left: 10px">No file chosen</span>
                </div>
                <div id="attachment-preview-${attachmentCount}" class="mt-2 preview-container col-12" style="display: none;"></div>
                @error('attachments.*')
                    <span class="text-danger ml-2">{{ $message }}</span>
                @enderror`;

            attachmentContainer.insertBefore(newAttachment, attachmentContainer.querySelector('.col-2'));

            // Initialize the new attachment input
            const newInput = document.getElementById(`attachment-${attachmentCount}`);
            const newText = document.getElementById(`attachment-text-${attachmentCount}`);
            const newPreview = document.getElementById(`attachment-preview-${attachmentCount}`);
            const newChooseBtn = newInput.closest('.input-group').querySelector('.choose-file-btn');
            newChooseBtn.addEventListener('click', () => newInput.click());
            newInput.addEventListener('change', () => handleFileSelect(newInput, newText, newPreview));
        }

        // Add attachment handler
        document.getElementById('add-attachment').addEventListener('click', addAttachmentFrame);

        // Initial attachment input handler
        const initialInput = document.getElementById('attachment-0');
        const initialText = document.getElementById('attachment-text-0');
        const initialPreview = document.getElementById('attachment-preview-0');
        const initialChooseBtn = initialInput.closest('.input-group').querySelector('.choose-file-btn');
        initialChooseBtn.addEventListener('click', () => initialInput.click());
        initialInput.addEventListener('change', () => handleFileSelect(initialInput, initialText, initialPreview));

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
                    replaceBtn.textContent = 'Replace';
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
                    files[indexToReplace] = newFile;

                    const dataTransfer = new DataTransfer();
                    files.forEach(file => dataTransfer.items.add(file));
                    input.files = dataTransfer.files;

                    handleFileSelect(input, input.closest('.input-group').querySelector('span'), input.closest('.input-group').nextElementSibling);
                }
                document.body.removeChild(tempInput);
            });

            tempInput.click();
        }
    });
</script>

<!-- Minimal CSS -->
<style>
    .input-block.local-forms {
        margin-bottom: 1rem;
    }
    .form-label {
        font-weight: 500;
        font-size: 0.875rem;
    }
    .input-group .form-control.border-0 {
        background: transparent;
        color: #6c757d;
        font-size: 0.875rem;
        padding: 0.375rem 0;
    }
    .choose-file-btn, .remove-file, .replace-file, #add-attachment {
        padding: 6px 12px;
        font-size: 0.875rem;
    }
    .attachment-row {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 0.25rem;
    }
    .form-select-sm {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }
    .text-danger {
        font-size: 0.8rem;
    }
    .card-title {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
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
    }
    table.table-striped {
        width: 100%;
    }
    table.table-striped th,
    table.table-striped td {
        padding: 8px;
        text-align: left;
    }
    #user-search {
        margin-bottom: 10px;
    }
</style>
@endsection