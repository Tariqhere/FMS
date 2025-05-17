@extends('backend.layout.auth')

@section('backend')
<div class="content-wrapper ">
    <section class="section ms-4 me-4">
        <div class="col-lg-12">
            <div class="card ">
                <div class="card-body">
                    <!-- Back Button (Top Right) -->
                    <div class="col-12">
                        <a href="{{ route('department.index') }}" class="btn btn-secondary btn-sm position-absolute top-0 end-0 m-3">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>

                    <div class="col-12">
                        <div class="form-heading">
                            <h4>Department Edit</h4>
                        </div>
                    </div>

                    <!-- Form Start -->
                    <form action="{{ route('department.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Title Input and Code Input in the Same Row -->
                        <div class="row mb-3">
                            <!-- Name Input -->
                            <div class="col-sm-6">
                                <div class="input-block local-forms">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $model->name }}">
                                </div>
                            </div>
                            <!-- Code Input -->
                            <div class="col-sm-6">
                                <div class="input-block local-forms">
                                    <label for="code" class="col-sm-2 col-form-label">Code</label>
                                    <input type="number" class="form-control" id="code" name="code" value="{{ $model->code }}">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button (Left Bottom) -->
                        <div class="col-12 text-start mt-3">
                            <button type="submit" class="btn btn-primary btn-sm" style="font-size: 12px; padding: 6px 12px;">
                                Submit
                            </button>
                        </div>
                    </form>
                    <!-- Form End -->
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
