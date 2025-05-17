@extends('backend.layout.auth')
@section('backend')
<div class="content-wrapper ">
    <section class="section ms-4 me-4">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body">
                    {!! html()->form('POST', route('department.store'))->attribute('enctype', 'multipart/form-data')->open() !!}
                    <div class="row">

                        <!-- Back Button (Top Right) -->
                        <div class="col-12">
                            <a href="{{ route('department.index') }}" class="btn btn-secondary btn-sm position-absolute top-0 end-0 m-3">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                        </div>

                        <div class="col-12">
                            <div class="form-heading">
                                <h4>Department Create</h4>
                            </div>
                        </div>

                        <!-- Title Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Name')->class('form-label') !!}
                                {!! html()->text('name')->id('name')->class('form-control form-control-sm') ->placeholder('Enter Name') !!}
                            </div>
                        </div>

                        <!-- Code Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Code')->class('form-label') !!}
                                {!! html()->number('code')->id('code')->class('form-control form-control-sm') ->placeholder('Enter Contact Code') !!}
                            </div>
                        </div>

                        <!-- Submit Button (Left Bottom) -->
                        <div class="col-12 text-start mt-3">
                            {!! html()->submit('Submit')->class('btn btn-primary btn-sm') ->style('font-size: 12px; padding: 6px 12px;') !!}
                        </div>
                    </div>
                    {!! html()->form()->close() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
