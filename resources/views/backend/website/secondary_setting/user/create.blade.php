@extends('backend.layout.auth')

@section('backend')
<div class="content-wrapper">
  <section class="section ms-4 me-4">
    <div class="content">
      <!-- /Page Header -->
      <div class="row">
        <div class="col-sm-12">
          <div class="card card-table show-entire">
            <div class="card-body">
              <!-- Table Header -->
              <div class="page-table-header mb-4">
                <div class="row align-items-center">
                  <div class="col">
                    <h3 class="font-weight-bold">Create User</h3>
                  </div>
                  <div class="col-auto text-end">
                    <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm rounded-pill" style="font-size: 10px;">
                      <i class="fa fa-plus"></i> Back
                    </a>
                  </div>
                </div>
              </div>
                        <div class="card-body">
                            <!-- Form -->
                            {!! html()->form('POST', route('user.store'))->attribute('enctype', 'multipart/form-data')->open() !!}  
                            <div class="row">
                                <!-- Name Field -->
                                 <div class="row mb-3">
                                     <div class="col-sm-6">
                                       <div class="input-block local-forms">
                                        {!! html()->label('name')->class('form-label') !!}
                                        {!! html()->text('name')->id('name')->class('form-control')->placeholder('Enter Name')->required() !!}
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>
                                      </div>
                                      <div class="col-sm-6">
                                      <div class="input-block local-forms">
                                        {!! html()->label('email')->class('form-label') !!}
                                        {!! html()->text('email')->id('email')->class('form-control')->placeholder('Enter Email')->required() !!}
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>

  <div class="row mb-3">
                                     <div class="col-sm-6">
                                         <div class="input-block local-forms">
                                        {!! html()->label('image')->class('form-label') !!}
                                        {!! html()->file('image')->class('form-control')->id('image')->accept('image/*')->required() !!}
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                       </div>
                                      </div>
                                      <div class="col-sm-6">
                                     <div class="input-block local-forms">
                                        {!! html()->label('cnic')->class('form-label') !!}
                                        {!! html()->number('cnic')->id('cnic')->class('form-control')->placeholder('Enter CNIC')->required() !!}
                                        @error('cnic')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                </div>

                                <!-- Office and Department Dropdown -->
                                <div class="row mb-3">
                                     <div class="col-sm-6">
                                     <div class="input-block local-forms">
                                        {!! html()->label('office_id')->class('form-label') !!}
                                        {!! html()->select('office_id', $offices)->class('form-select')->id('office_id')->placeholder('Select Office')->required() !!}
                                        @error('office_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                     </div>
                                     </div>
                                     <div class="col-sm-6">
                                     <div class="input-block local-forms">
                                        {!! html()->label('department')->class('form-label') !!}
                                        {!! html()->select('department_id', $departments)->class('form-select')->id('department')->placeholder('Select Department')->required() !!}
                                        @error('department_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                     </div>
                                     </div>
                                </div>

                                <!-- Contact Number Field -->
                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                     <div class="input-block local-forms">
                                        {!! html()->label('contact')->class('form-label') !!}
                                        {!! html()->number('contact')->class('form-control')->id('contact')->placeholder('Enter Contact')->required()  !!}
                                        @error('contact')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
        </div>
    </section>
</div>
@endsection
