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
                    <h3 class="font-weight-bold">Edit User</h3>
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
                {!! html()->form('PUT', route('user.update', $model->id))
                    ->attribute('enctype', 'multipart/form-data')
                    ->open() !!}

                  <div class="row">
                    <!-- Name and Email Fields -->
                    <div class="row mb-3">
                      <div class="col-sm-6">
                        <div class="input-block local-forms">
                          {!! html()->label('Name')->class('form-label') !!}
                          {!! html()->text('name')->id('name')->class('form-control')->placeholder('Enter Name')->value(old('name', $model->name))->required() !!}
                          @error('name')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-block local-forms">
                          {!! html()->label('Email')->class('form-label') !!}
                          {!! html()->text('email')->id('email')->class('form-control')->placeholder('Enter Email')->value(old('email', $model->email))->required() !!}
                          @error('email')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>

                    <!-- Image and CNIC Fields -->
                    <div class="row mb-3">
                      <div class="col-sm-6">
                        <div class="input-block local-forms">
                          {!! html()->label('Image')->class('form-label') !!}
                          {!! html()->file('image')->class('form-control')->id('image')->accept('image/*') !!}
                          @error('image')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-block local-forms">
                          {!! html()->label('CNIC')->class('form-label') !!}
                          {!! html()->number('cnic')->id('cnic')->class('form-control')->placeholder('Enter CNIC')->value(old('cnic', $model->cnic))->required() !!}
                          @error('cnic')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>

                    <!-- Office and Department Fields -->
                    <div class="row mb-3">
                      <div class="col-sm-6">
                        <div class="input-block local-forms">
                          {!! html()->label('Office')->class('form-label') !!}
                          {!! html()->select('office_id', $offices)->class('form-select')->id('office_id')->placeholder('Select Office')->value(old('office_id', $model->office_id))->required() !!}
                          @error('office_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="input-block local-forms">
                          {!! html()->label('Department')->class('form-label') !!}
                          {!! html()->select('department_id', $departments)->class('form-select')->id('department_id')->placeholder('Select Department')->value(old('department_id', $model->department_id))->required() !!}
                          @error('department_id')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>

                    <!-- Contact Field -->
                    <div class="row mb-3">
                      <div class="col-sm-6">
                        <div class="input-block local-forms">
                          {!! html()->label('Contact')->class('form-label') !!}
                          {!! html()->number('contact')->class('form-control')->id('contact')->placeholder('Enter Contact')->value(old('contact', $model->contact))->required() !!}
                          @error('contact')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
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
        </div>
      </div>
    </section>
  </div>
@endsection
