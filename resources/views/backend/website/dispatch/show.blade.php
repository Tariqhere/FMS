@extends('backend.layout.auth')

@section('backend')
    <div class="content-wrapper">
        <section class="section ms-4 me-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- Back Button (Top Right) -->
                        <div class="col-12">
                            <a href="{{ route('dispatch.index') }}" class="btn btn-secondary btn-sm position-absolute top-0 end-0 m-3">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Dispatch Details</h4>
                                    </div>
                                </div>

                                <!-- Dispatch Details -->
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Dispatch Information</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p><strong>Title:</strong> {{ $model->title ?? 'N/A' }}</p>
                                                    <p><strong>Folder:</strong> {{ $model->folder->title ?? 'N/A' }}</p>
                                                    <p><strong>Flag:</strong> {{ $model->flag->title ?? 'N/A' }}</p>
                                                    <p><strong>Office:</strong> {{ $model->office->title ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p><strong>Dispatch Number:</strong> {{ $model->dispatch_number ?? 'N/A' }}</p>
                                                    <p><strong>File Number:</strong> {{ $model->file_number ?? 'N/A' }}</p>
                                                    <p><strong>Date:</strong> {{ $model->date ?? 'N/A' }}</p>
                                                    <p><strong>Time:</strong> {{ $model->time ?? 'N/A' }}</p>
                                                    <p><strong>Send To:</strong> {{ $model->send_to ?? 'N/A' }}</p>
                                                    <p><strong>Received From:</strong> {{ $model->received_from ?? 'N/A' }}</p>
                                                </div>
                                                <div class="col-12">
                                                    <p><strong>Description:</strong> {!! $model->description ?? 'N/A' !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Dispatch Details -->
{{--                                <div class="col-12">--}}
{{--                                    <div class="card mb-3">--}}
{{--                                        <div class="card-body">--}}
{{--                                            <h5 class="card-title">Dispatch Details</h5>--}}
{{--                                            @if($model->dispatchDocuments->isNotEmpty())--}}
{{--                                                <div class="table-responsive">--}}
{{--                                                    <table class="table table-striped">--}}
{{--                                                        <thead>--}}
{{--                                                        <tr>--}}
{{--                                                            <th>S#</th>--}}
{{--                                                            <th>Remarks</th>--}}
{{--                                                            <th>File</th>--}}
{{--                                                            <th>Status</th>--}}
{{--                                                        </tr>--}}
{{--                                                        </thead>--}}
{{--                                                        <tbody>--}}
{{--                                                        @foreach($model->dispatchDetails() as $document)--}}
{{--                                                            <tr>--}}
{{--                                                                <td>{{ $loop->iteration }}</td>--}}
{{--                                                                <td>{{ $document->remark ?? 'N/A' }}</td>--}}
{{--                                                                <td>--}}
{{--                                                                    <a href="{{ asset('storage/' . $document->file) }}" target="_blank">View File</a>--}}
{{--                                                                </td>--}}
{{--                                                                <td>{{ $document->status == 0 ? 'Pending' : ($document->status == 1 ? 'Approved' : 'Rejected') }}</td>--}}
{{--                                                            </tr>--}}
{{--                                                        @endforeach--}}
{{--                                                        </tbody>--}}
{{--                                                    </table>--}}
{{--                                                </div>--}}
{{--                                            @else--}}
{{--                                                <p>No documents available.</p>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}



                                <!-- Dispatch Documents -->
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Dispatch Documents</h5>
                                            @if($model->dispatchDocuments->isNotEmpty())
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>S#</th>
                                                            <th>Title</th>
                                                            <th>File</th>
                                                            <th>Status</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($model->dispatchDocuments as $document)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $document->title ?? 'N/A' }}</td>
                                                                <td>
                                                                    <a href="{{ asset('storage/' . $document->file) }}" target="_blank">View File</a>
                                                                </td>
                                                                <td>{{ $document->status == 0 ? 'Pending' : ($document->status == 1 ? 'Approved' : 'Rejected') }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p>No documents available.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Form for Remarks, Attachments, Status, and Users -->
                                {!! html()->form('POST', route('dispatch.update', $model->id))->attribute('enctype', 'multipart/form-data')->id('dispatch-details-form')->open() !!}
                                @csrf
                                @method('PUT')

                                <!-- Remarks Section -->
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Remarks</h5>
                                            <div class="input-block local-forms">
                                                {!! html()->label('Remark')->class('form-label') !!}
                                                <div id="quill-editor" class="quill-editor"></div>
                                                <input type="hidden" name="remark" id="remark">
                                                @error('remark')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- Display Existing Remarks -->
                                            @if($model->dispatchDetails->isNotEmpty())
                                                <h6 class="mt-3">Previous Remarks:</h6>
                                                @foreach($model->dispatchDetails as $detail)
                                                    @if($detail->remark)
                                                        <p><strong>{{ $detail->user->name ?? 'N/A' }}:</strong> {{ $detail->remark }}</p>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Attachment Section -->
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Add Attachments</h5>
                                            <div id="attachment-container" class="row">
                                                <div class="col-12 col-md-10 mb-2 attachment-row" data-attachment-id="0">
                                                    <p class="mb-2">Input Document Attachment</p>
                                                    <div class="input-group flex-grow-1 me-2 position-relative">
                                                        <input type="file" name="attachments[]" id="attachment-0" class="form-control form-control-sm attachment-input d-none" multiple>
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
                                                    <button type="button" id="add-attachment" class="btn btn-success btn-sm">Add more</button>
                                                </div>
                                            </div>
                                            <!-- Display Existing Attachments -->
                                            @if($model->dispatchDetails->isNotEmpty() && $model->dispatchDetails->first()->dispatchDetailDocument->isNotEmpty())
                                                <h6 class="mt-3">Existing Attachments:</h6>
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th>S#</th>
                                                            <th>Title</th>
                                                            <th>File</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($model->dispatchDetails->first()->dispatchDetailDocument as $doc)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $doc->title ?? 'N/A' }}</td>
                                                                <td>
                                                                    <a href="{{ asset('storage/' . $doc->file) }}" target="_blank">View File</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Selection -->
                                <div class="col-12 col-md-4">
                                    <div class="input-block local-forms">
                                        {!! html()->label('Status')->class('form-label') !!}
                                        {!! html()->select('status', $statuses, $model->dispatchDetails->first()->status ?? 0)->class('form-select')->id('status')->required() !!}
                                        @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Users Table -->
                                <div class="col-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">Assign Users</h5>
                                            <div class="input-group mb-3" style="max-width: 300px;">
                                                <input type="text" id="user-search" class="form-control form-control-sm" placeholder="Search by name..." aria-label="Search users">
                                            </div>
                                            <div id="user-container">
                                                <div class="table-responsive">
                                                    <table class="table" id="user-table" style="display: none;">
                                                        <thead>
                                                        <tr>
                                                            <th>S#</th>
                                                            <th>Name</th>
                                                            <th>Cnic_No</th>
                                                            <th>Office</th>
                                                            <th>Department</th>
                                                            <th>Contact_NO</th>
                                                            <th><input type="checkbox" id="select-all"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="user-table-body">
                                                        @foreach($users as $index => $user)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $user['name'] }}</td>
                                                                <td>{{ $user['cnic'] }}</td>
                                                                <td>{{ $user['office']['title'] ?? 'N/A' }}</td>
                                                                <td>{{ $user['department']['name'] ?? 'N/A' }}</td>
                                                                <td>{{ $user['contact'] }}</td>
                                                                <td>
                                                                    <input type="checkbox" name="selected_users[]" value="{{ $user['id'] }}"
                                                                        {{ $model->dispatchDetails->isNotEmpty() && $model->dispatchDetails->pluck('user_id')->contains($user['id']) ? 'checked' : '' }}>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-12 text-end mt-3">
                                    {!! html()->submit('Submit')->class('btn btn-primary btn-sm') !!}
                                </div>
                                {!! html()->form()->close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Quill Editor CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.0/quill.snow.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.0/quill.min.js"></script>

    <!-- Preload Boxicons font -->
    <link rel="preload" href="{{ asset('backend/vendor/fonts/boxicons/boxicons.woff2') }}" as="font" type="font/woff2" crossorigin>

    <!-- JavaScript for Quill Editor and Attachments -->
    <script>
        // Initialize Quill Editor
        var quill = new Quill('#quill-editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    ['link', 'blockquote', 'code-block'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                ]
            }
        });

        quill.on('text-change', function () {
            document.getElementById('remarks').value = quill.root.innerHTML;
        });

        // Attachment Handling
        let attachmentCount = 1;

        $(document).on('click', '.choose-file-btn', function () {
            const attachmentId = $(this).closest('.attachment-row').data('attachment-id');
            $(`#attachment-${attachmentId}`).click();
        });

        $(document).on('change', '.attachment-input', function () {
            const attachmentId = $(this).closest('.attachment-row').data('attachment-id');
            const files = this.files;
            const previewContainer = $(`#attachment-preview-${attachmentId}`);
            const attachmentText = $(`#attachment-text-${attachmentId}`);

            if (files.length > 0) {
                attachmentText.text(files[0].name);
                previewContainer.empty().show();
                if (files[0].type.startsWith('image/')) {
                    const img = $('<img>').attr('src', URL.createObjectURL(files[0])).css({ 'max-width': '100px', 'margin-top': '10px' });
                    previewContainer.append(img);
                }
                $(`button[data-attachment-id="${attachmentId}"]`).removeClass('d-none');
            } else {
                attachmentText.text('No file chosen');
                previewContainer.hide();
            }
        });

        $('#add-attachment').click(function () {
            const newRow = `
            <div class="col-12 col-md-10 mb-2 attachment-row" data-attachment-id="${attachmentCount}">
                <p class="mb-2">Input Document Attachment</p>
                <div class="input-group flex-grow-1 me-2 position-relative">
                    <input type="file" name="attachments[]" id="attachment-${attachmentCount}" class="form-control form-control-sm attachment-input d-none" multiple>
                    <button type="button" class="btn btn-outline-secondary btn-sm choose-file-btn">Choose File</button>
                    <span id="attachment-text-${attachmentCount}" class="form-control form-control-sm border-0" style="margin-left: 10px">No file chosen</span>
                    <button type="button" class="btn btn-outline-danger btn-sm remove-attachment-row d-none" data-attachment-id="${attachmentCount}">Remove</button>
                </div>
                <div id="attachment-preview-${attachmentCount}" class="mt-2 preview-container col-12" style="display: none;"></div>
            </div>`;
            $('#attachment-container').append(newRow);
            attachmentCount++;
        });

        $(document).on('click', '.remove-attachment-row', function () {
            $(this).closest('.attachment-row').remove();
        });

        // User Search
        const allUsers = @json($users);
        const userTableBody = $('#user-table-body');
        const userTable = $('#user-table');
        const selectAllCheckbox = $('#select-all');

        function renderUsers(users) {
            userTableBody.empty();
            if (users.length === 0) {
                userTable.hide();
                return;
            }
            users.forEach((user, index) => {
                const isChecked = @json($model->dispatchDetails->isNotEmpty() ? $model->dispatchDetails->pluck('user_id')->toArray() : []).includes(user.id) ? 'checked' : '';
                const row = `
            <tr>
                <td>${index + 1}</td>
                <td>${user.name}</td>
                <td>${user.cnic}</td>
                <td>${user.office ? user.office.title : 'N/A'}</td>
                <td>${user.department ? user.department.name : 'N/A'}</td>
                <td>${user.contact}</td>
                <td><input type="checkbox" name="selected_users[]" value="${user.id}" ${isChecked}></td>
            </tr>`;
                userTableBody.append(row);
            });
            userTable.show();
        }

        $('#user-search').on('input', function () {
            const searchTerm = $(this).val().toLowerCase();
            const filteredUsers = allUsers.filter(user =>
                user.name.toLowerCase().includes(searchTerm) ||
                user.cnic.toLowerCase().includes(searchTerm)
            );
            renderUsers(filteredUsers);
        });

        selectAllCheckbox.on('change', function () {
            userTableBody.find('input[type="checkbox"]').prop('checked', this.checked);
        });

        // Initial render
        renderUsers(allUsers);
    </script>
@endsection

{{--@extends('backend.layout.auth')--}}
{{--@section('backend')--}}
{{--<div class="content-wrapper">--}}
{{--    <section class="section">--}}
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <!-- Back Button (Top Right) -->--}}
{{--                            <div class="col-12">--}}
{{--                                <a href="{{ route('dispatch.index') }}" class="btn btn-secondary btn-sm position-absolute top-0 end-0 m-3" data-bs-toggle="tooltip" title="Back to Dispatch List">--}}
{{--                                    <i class="bi bi-arrow-left"></i> Back--}}
{{--                                </a>--}}
{{--                            </div>--}}

{{--                            <div class="col-12">--}}
{{--                                <div class="form-heading">--}}
{{--                                    <h4>Dispatch Details</h4>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- First Row: Title, Folder, Flag -->--}}
{{--                            <div class="col-12 col-md-6">--}}
{{--                                <div class ="input-block local-forms">--}}
{{--                                    {!! html()->label('Title', 'title')->class('form-label') !!}--}}
{{--                                    <input type="text" class="form-control form-control-sm" value="{{ $model->title ?? 'N/A' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 col-md-3">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('Folder', 'folder_id')->class('form-label') !!}--}}
{{--                                    <input type="text" class="form-control form-control-sm" value="{{ $flags[$model->folder_id] ?? 'N/A' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 col-md-3">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('Flag', 'flag_id')->class('form-label') !!}--}}
{{--                                    <input type="text" class="form-control form-control-sm" value="{{ $flags[$model->flag_id] ?? 'N/A' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Second Row: Office, Dispatch Number, File Number -->--}}
{{--                            <div class="col-12 col-md-4">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('Office', 'office_id')->class('form-label') !!}--}}
{{--                                    <input type="text" class="form-control form-control-sm" value="{{ $offices[$model->office_id] ?? 'N/A' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 col-md-4">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('Dispatch Number', 'dispatch_number')->class('form-label') !!}--}}
{{--                                    <input type="text" class="form-control form-control-sm" value="{{ $model->dispatch_number ?? 'N/A' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 col-md-4">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('File Number', 'file_number')->class('form-label') !!}--}}
{{--                                    <input type="text" class="form-control form-control-sm" value="{{ $model->file_number ?? 'N/A' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Third Row: Received From, Send To, Date, Time -->--}}
{{--                            <div class="col-12 col-md-4">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('Received From', 'received_from')->class('form-label') !!}--}}
{{--                                    <input type="text" class="form-control form-control-sm" value="{{ $model->received_from ?? 'N/A' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 col-md-4">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('Send To', 'send_to')->class('form-label') !!}--}}
{{--                                    <input type="text" class="form-control form-control-sm" value="{{ $model->send_to ?? 'N/A' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 col-md-4">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('Date', 'date')->class('form-label') !!}--}}
{{--                                    <input type="date" class="form-control form-control-sm" value="{{ $model->date ?? '' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 col-md-4">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('Time', 'dispatch_time')->class('form-label') !!}--}}
{{--                                    <input type="time" class="form-control form-control-sm" value="{{ $model->dispatch_time ?? '' }}" readonly>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Last Row: Description -->--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="input-block local-forms">--}}
{{--                                    {!! html()->label('Para/Description', 'description')->class('form-label') !!}--}}
{{--                                    <div id="editor" class="quill-editor"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Attachments Card -->--}}
{{--                           <div class="col-12 mt-3">--}}
{{--                             <div class="card">--}}
{{--                                <div class="card-body">--}}
{{--                                         <h5 class="card-title">Attachments</h5>--}}
{{--                                     @if($model->attachmentFiles && $model->attachmentFiles->count() > 0)--}}
{{--    <div class="row">--}}
{{--        @foreach($model->attachmentFiles as $attachment)--}}
{{--            <div class="col-12 col-md-4 mb-3">--}}
{{--                <div class="attachment-preview border rounded p-2 text-center">--}}
{{--                    @if(in_array(strtolower(pathinfo($attachment->file_name, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png']))--}}
{{--                        <img src="{{ asset('storage/' . $attachment->file_path) }}" alt="{{ $attachment->file_name }}" class="img-fluid mb-2" style="max-height: 100px;">--}}
{{--                    @else--}}
{{--                        <i class="bi bi-file-earmark-pdf text-danger fs-3 mb-2"></i>--}}
{{--                        <p class="mb-0">{{ $attachment->file_name }}</p>--}}
{{--                    @endif--}}
{{--                    <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm mt-2" data-bs-toggle="tooltip" title="View Attachment">--}}
{{--                        View--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--@else--}}
{{--    <p class="text-muted">No attachments available.</p>--}}
{{--@endif--}}
{{--                                                   </div>--}}
{{--                                                   </div>--}}
{{--                             </div>--}}


{{--                            <!-- Users Table Card -->--}}
{{--                            <div class="col-12 mt-3">--}}
{{--                                <div class="card">--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h5 class="card-title">Assigned Users</h5>--}}
{{--                                        <div class="input-group mb-3" style="max-width: 300px;">--}}
{{--                                            <input type="text" id="user-search" class="form-control form-control-sm" placeholder="Search by name..." aria-label="Search users">--}}
{{--                                        </div>--}}
{{--                                        <div id="user-container">--}}
{{--                                            <div class="table-responsive">--}}
{{--                                                <table class="table" id="user-table" style="display: none;">--}}
{{--                                                    <thead>--}}
{{--                                                        <tr>--}}
{{--                                                            <th>S#</th>--}}
{{--                                                            <th>Name</th>--}}
{{--                                                            <th>Cnic_No</th>--}}
{{--                                                            <th>Office</th>--}}
{{--                                                            <th>Department</th>--}}
{{--                                                            <th>Contact_NO</th>--}}
{{--                                                            <th>Selected</th>--}}
{{--                                                        </tr>--}}
{{--                                                    </thead>--}}
{{--                                                    <tbody id="user-table-body"></tbody>--}}
{{--                                                </table>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <!-- Action Buttons -->--}}
{{--                            <div class="col-12 mt-4 text-start">--}}
{{--                                <a href="{{ route('dispatch.edit', $model->id) }}" class="btn btn-primary btn-sm me-2" data-bs-toggle="tooltip" title="Edit Dispatch">--}}
{{--                                    <i class="bi bi-pencil-fill me-1"></i> Edit--}}
{{--                                </a>--}}
{{--                                <form action="{{ route('dispatch.destroy', $model->id) }}" method="POST" style="display: inline;">--}}
{{--                                    @csrf--}}
{{--                                    @method('DELETE')--}}
{{--                                    <button type="submit" class="btn btn-danger btn-sm delete-btn" data-bs-toggle="tooltip" title="Delete Dispatch">--}}
{{--                                        <i class="bi bi-trash me-1"></i> Delete--}}
{{--                                    </button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
{{--</div>--}}

{{--<!-- SweetAlert2 CDN for Delete Confirmation -->--}}
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

{{--<!-- Quill Editor CDN -->--}}
{{--<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">--}}
{{--<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>--}}

{{--<!-- JavaScript for Interactivity -->--}}
{{--<script>--}}
{{--    document.addEventListener('DOMContentLoaded', function () {--}}
{{--        // Initialize Bootstrap Tooltips--}}
{{--        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');--}}
{{--        tooltipTriggerList.forEach(tooltipTriggerEl => {--}}
{{--            new bootstrap.Tooltip(tooltipTriggerEl);--}}
{{--        });--}}

{{--        // Delete Confirmation with SweetAlert2--}}
{{--        document.querySelectorAll('.delete-btn').forEach(button => {--}}
{{--            button.addEventListener('click', function (e) {--}}
{{--                e.preventDefault();--}}
{{--                const form = this.closest('form');--}}

{{--                Swal.fire({--}}
{{--                    title: 'Are you sure?',--}}
{{--                    text: 'This action will permanently delete the dispatch record.',--}}
{{--                    icon: 'warning',--}}
{{--                    showCancelButton: true,--}}
{{--                    confirmButtonColor: '#dc3545',--}}
{{--                    cancelButtonColor: '#6c757d',--}}
{{--                    confirmButtonText: 'Yes, delete it!',--}}
{{--                    cancelButtonText: 'Cancel'--}}
{{--                }).then((result) => {--}}
{{--                    if (result.isConfirmed) {--}}
{{--                        form.submit();--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}

{{--        // Initialize Quill Editor in read-only mode--}}
{{--        const quill = new Quill('#editor', {--}}
{{--            theme: 'snow',--}}
{{--            readOnly: true,--}}
{{--            modules: {--}}
{{--                toolbar: false--}}
{{--            }--}}
{{--        });--}}

{{--        // Set initial content--}}
{{--        quill.root.innerHTML = @json($model->description) || 'N/A';--}}

{{--        // Pass users data to JavaScript--}}
{{--        const allUsers = @json($users);--}}
{{--        const dispatchUsers = @json($model->users->pluck('id')->toArray());--}}

{{--        // Users Table Logic--}}
{{--        const userTable = document.getElementById('user-table');--}}
{{--        const userTableBody = document.getElementById('user-table-body');--}}
{{--        const userSearch = document.getElementById('user-search');--}}

{{--        let currentFilteredUsers = [];--}}

{{--        // Initialize users table based on dispatch office--}}
{{--        function initializeUserTable() {--}}
{{--            const selectedOfficeId = '{{ $model->office_id }}';--}}
{{--            currentFilteredUsers = allUsers.filter(user => user.office_id == selectedOfficeId);--}}
{{--            updateUserTable(currentFilteredUsers);--}}
{{--        }--}}

{{--        // Search handler--}}
{{--        userSearch.addEventListener('input', function () {--}}
{{--            const searchTerm = this.value.toLowerCase();--}}
{{--            const filtered = currentFilteredUsers.filter(user =>--}}
{{--                user.name.toLowerCase().includes(searchTerm)--}}
{{--            );--}}
{{--            updateUserTable(filtered);--}}
{{--        });--}}

{{--        // Function to update user table--}}
{{--        function updateUserTable(users) {--}}
{{--            userTableBody.innerHTML = '';--}}
{{--            if (users.length > 0) {--}}
{{--                users.forEach((user, index) => {--}}
{{--                    const row = document.createElement('tr');--}}
{{--                    const isSelected = dispatchUsers.includes(user.id);--}}
{{--                    row.innerHTML = `--}}
{{--                        <td>${index + 1}</td>--}}
{{--                        <td>${user.name || 'N/A'}</td>--}}
{{--                        <td>${user.cnic || 'N/A'}</td>--}}
{{--                        <td>${user.office?.title || 'N/A'}</td>--}}
{{--                        <td>${user.department?.name || 'N/A'}</td>--}}
{{--                        <td>${user.contact || 'N/A'}</td>--}}
{{--                        <td><input type="checkbox" disabled ${isSelected ? 'checked' : ''}></td>`;--}}
{{--                    userTableBody.appendChild(row);--}}
{{--                });--}}
{{--                userTable.style.display = 'table';--}}
{{--            } else {--}}
{{--                const row = document.createElement('tr');--}}
{{--                row.innerHTML = '<td colspan="7">No users found</td>';--}}
{{--                userTableBody.appendChild(row);--}}
{{--                userTable.style.display = 'table';--}}
{{--            }--}}
{{--        }--}}

{{--        // Initialize user table--}}
{{--        initializeUserTable();--}}
{{--    });--}}
{{--</script>--}}

{{--<!-- Minimal CSS -->--}}
{{--<style>--}}
{{--    .content-wrapper {--}}
{{--        width: 100%;--}}
{{--        max-width: 100%;--}}
{{--        overflow-x: auto;--}}
{{--        padding: 15px;--}}
{{--    }--}}
{{--    .section {--}}
{{--        width: 100%;--}}
{{--        max-width: 100%;--}}
{{--    }--}}
{{--    .card {--}}
{{--        width: 100%;--}}
{{--        max-width: 100%;--}}
{{--        border: none;--}}
{{--        border-radius: 8px;--}}
{{--        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);--}}
{{--    }--}}
{{--    .input-block.local-forms {--}}
{{--        margin-bottom: 1rem;--}}
{{--    }--}}
{{--    .form-label {--}}
{{--        font-weight: 500;--}}
{{--        font-size: 0.875rem;--}}
{{--        color: #495057;--}}
{{--    }--}}
{{--    .form-control-sm, .form-select {--}}
{{--        font-size: 0.875rem;--}}
{{--        background-color: #f8f9fa;--}}
{{--    }--}}
{{--    .form-control[readonly], .form-select:disabled {--}}
{{--        background-color: #e9ecef;--}}
{{--        opacity: 1;--}}
{{--        cursor: not-allowed;--}}
{{--    }--}}
{{--    .text-danger {--}}
{{--        font-size: 0.8rem;--}}
{{--    }--}}
{{--    .card-title {--}}
{{--        font-size: 1rem;--}}
{{--        font-weight: 600;--}}
{{--        margin-bottom: 1rem;--}}
{{--        color: #343a40;--}}
{{--    }--}}
{{--    .quill-editor {--}}
{{--        min-height: 200px;--}}
{{--        width: 100%;--}}
{{--        background: #f8f9fa;--}}
{{--        border: 1px solid #dee2e6;--}}
{{--        border-radius: 0 0 0.25rem 0.25rem;--}}
{{--    }--}}
{{--    .ql-editor {--}}
{{--        min-height: 200px;--}}
{{--        font-family: Helvetica, Arial, sans-serif;--}}
{{--        font-size: 14px;--}}
{{--    }--}}
{{--    .ql-container {--}}
{{--        border: none;--}}
{{--    }--}}
{{--    .attachment-preview {--}}
{{--        background: #f8f9fa;--}}
{{--    }--}}
{{--    .attachment-preview img {--}}
{{--        max-width: 100%;--}}
{{--        height: auto;--}}
{{--    }--}}
{{--    .table-responsive {--}}
{{--        border-radius: 8px;--}}
{{--        overflow: hidden;--}}
{{--    }--}}
{{--    .table {--}}
{{--        width: 100%;--}}
{{--        border-collapse: collapse;--}}
{{--    }--}}
{{--    .table thead th {--}}
{{--        font-weight: 600;--}}
{{--        font-size: 0.9rem;--}}
{{--        padding: 12px 15px;--}}
{{--        text-transform: uppercase;--}}
{{--        letter-spacing: 0.5px;--}}
{{--        vertical-align: middle;--}}
{{--        border-bottom: 1px solid #dee2e6;--}}
{{--    }--}}
{{--    .table tbody td {--}}
{{--        font-size: 0.875rem;--}}
{{--        padding: 10px 15px;--}}
{{--        vertical-align: middle;--}}
{{--        border-bottom: 1px solid #dee2e6;--}}
{{--    }--}}
{{--    #user-search {--}}
{{--        margin-bottom: 10px;--}}
{{--    }--}}
{{--    @media (max-width: 767px) {--}}
{{--        .form-control-sm, .form-select {--}}
{{--            font-size: 0.75rem;--}}
{{--        }--}}
{{--        .btn-sm {--}}
{{--            font-size: 0.75rem;--}}
{{--            padding: 4px 8px;--}}
{{--        }--}}
{{--        .card-body {--}}
{{--            padding: 10px;--}}
{{--        }--}}
{{--        .table {--}}
{{--            display: block;--}}
{{--            overflow-x: auto;--}}
{{--            white-space: nowrap;--}}
{{--        }--}}
{{--        .table thead th, .table tbody td {--}}
{{--            min-width: 100px;--}}
{{--        }--}}
{{--    }--}}
{{--</style>--}}
{{--@endsection--}}
