
 @extends('backend.layout.auth')
@section('backend')
<div class="content-wrapper ">
    <section class="section ms-4 me-4">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body">
                    {!! html()->modelform($model, 'PUT', route('dispatch.update',$model->id))->attribute('enctype', 'multipart/form-data')->open() !!}
                    <div class="row">

                        <!-- Back Button (Top Right) -->
                        <div class="col-12">
                            <a href="{{ route('dispatch.index') }}" class="btn btn-secondary btn-sm position-absolute top-0 end-0 m-3">
                                <i class="bi bi-arrow-left"></i> Back
                            </a>
                        </div>

                        <div class="col-12">
                            <div class="form-heading">
                                <h4>Depatch Create</h4>
                            </div>
                        </div>

                        <!-- Title Input -->
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Title')->class('form-label') !!}
                                {!! html()->text('title')->id('title')->class('form-control form-control-sm') ->placeholder('Enter Title') !!}
                            </div>
                           </div>

                         <!-- Code Input -->
                          <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Description')->class('form-label') !!}
                                {!! html()->number('description')->id('description')->class('form-control form-control-sm') ->placeholder('Enter Contact description') !!}
                            </div>
                        </div>

                           <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Remark')->class('form-label') !!}
                                {!! html()->text('remark')->id('remark')->class('form-control form-control-sm') ->placeholder('Enter Remark') !!}
                            </div>
                           </div>

                         <!-- Code Input -->
                       

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

                         <!-- Code Input -->
                          <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Dispatch date')->class('form-label') !!}
                                {!! html()->date('dispatch_date')->id('dispatch_date')->class('form-control form-control-sm') ->placeholder('Enter Contact dispatch_date') !!}
                            </div>
                        </div>

                           <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                {!! html()->label('Complete date')->class('form-label') !!}
                                {!! html()->date('complete_date')->id('complete_date')->class('form-control form-control-sm') ->placeholder('Enter complete_date') !!}
                            </div>
                           </div>

                           Code Input -->
                              <div class="col-12 col-md-6">
                                    <div class="input-block local-forms">
                                        {!! html()->label( 'Flag/Folders')->class('form-label') !!}
                                        {!! html()->select('flag_id', $users)->class('form-select')->id('flag_id')->placeholder('Select Flag/Folders')->required() !!}
                                        @error('flag_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                         <!-- Code Input -->
                              <div class="col-12 col-md-6">
                                    <div class="input-block local-forms">
                                        {!! html()->label( 'users')->class('form-label') !!}
                                        {!! html()->select('user_id', $users)->class('form-select')->id('user_id')->placeholder('Select Use')->required() !!}
                                        @error('user_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                        

                                      <div class="col-12 col-md-6 ">
                                    <div class="input-block local-forms">
                                        {!! html()->label( 'Office')->class('form-label') !!}
                                        {!! html()->select('office_id', $offices)->class('form-select')->id('office_id')->placeholder('Select Office')->required() !!}
                                        @error('office_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
