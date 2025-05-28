@extends('backend.layout.auth')
@section('backend')
<div class="content-wrapper">
    <section class="section">
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
                        {!! html()->form('POST', route('dispatch.store'))->attribute('enctype', 'multipart/form-data')->id('dispatch-form')->open() !!}
                        @csrf
                        <div class="row">

                            <div class="col-12">
                                <div class="form-heading">
                                    <h4>Dispatch Create</h4>
                                </div>
                            </div>

                            <!-- First Row: Title, Folder, Flag -->
                            <div class="col-12 col-md-6">
                                <div class="input-block local-forms">
                                    {!! html()->label('Title <span style="color: red;">*</span>', 'title')->class('form-label') !!}
                                    {!! html()->text('title')->id('title')->class('form-control form-control-sm')->placeholder('Enter Title')->required() !!}
                                    @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="input-block local-forms">
                                    {!! html()->label('Folders')->class('form-label') !!}
                                    {!! html()->select('folder_id', $folders)->class('form-select')->id('folder_id')->placeholder('Select folder')->required() !!}
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

                            <!-- Second Row: Office, Dispatch Number, File Number -->
                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Office <span style="color: red;">*</span>', 'office_id')->class('form-label') !!}
                                    {!! html()->select('office_id', $offices)->class('form-select')->id('office_id')->placeholder('Select Office')->required() !!}
                                    @error('office_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Dispatch Number <span style="color: red;">*</span>', 'dispatch_number')->class('form-label') !!}
                                    {!! html()->text('dispatch_number')->id('dispatch_number')->class('form-control form-control-sm')->placeholder('Enter Dispatch Number')->required() !!}
                                    @error('dispatch_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('File Number <span style="color: red;">*</span>', 'file_number')->class('form-label') !!}
                                    {!! html()->text('file_number')->id('file_number')->class('form-control form-control-sm')->placeholder('Enter File Number')->required() !!}
                                    @error('file_number')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Third Row: Received From, Send To, Date, Time -->
                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Received From <span style="color: red;">*</span>', 'received_from')->class('form-label') !!}
                                    {!! html()->text('received_from')->id('received_from')->class('form-control form-control-sm')->placeholder('Received From')->required() !!}
                                    @error('received_from')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Send To <span style="color: red;">*</span>', 'send_to')->class('form-label') !!}
                                    {!! html()->text('send_to')->id('send_to')->class('form-control form-control-sm')->placeholder('Send To')->required() !!}
                                    @error('send_to')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Date')->class('form-label') !!}
                                    {!! html()->date('date')->id('date')->class('form-control form-control-sm') !!}
                                    @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="input-block local-forms">
                                    {!! html()->label('Time <span style="color: red;">*</span>', 'time')->class('form-label') !!}
                                    {!! html()->time('time')->id('time')->class('form-control form-control-sm')->required() !!}
                                    @error('time')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Row: Description -->
                            <div class="col-12">
                                <div class="input-block local-forms">
                                    {!! html()->label('Para/Description')->class('form-label') !!}
                                    <div id="quill-editor" class="quill-editor"></div>
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
                                                    <tbody id="user-table-body"></tbody>
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

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Quill Editor CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.0/quill.snow.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.0/quill.min.js"></script>

<!-- Preload Boxicons font -->
<link rel="preload" href="{{ asset('backend/vendor/fonts/boxicons/boxicons.woff2') }}" as="font" type="font/woff2" crossorigin>

<!-- Pass all users from PHP to JS -->
<script>
    const allUsers = @json($users);
</script>
@endsection
