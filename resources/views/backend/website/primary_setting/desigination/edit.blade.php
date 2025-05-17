@extends('backend.layout.auth')

@section('backend')
<div class="content-wrapper">
    <section class="section ms-4 me-4">
        <div class="row align-items-center">
        </div>
        <div class="col-12">
            <div class="card ms-4 me-4">
                <div class="card-body">
                    <div class="col-12">
                        <a href="{{ route('desigination.index') }}" class="btn btn-secondary btn-sm position-absolute top-0 end-0 m-3">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                    </div>
                    <h5 class="card-title">gesigination Edit </h5>
                    <!-- General Form Elements -->
                    <form action="{{ route('desigination.update', $model->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT') <!-- This tells Laravel to treat this as an update request -->
                  
                  
                      <div class="row mb-3">
                          <div class="col-sm-5">
                              <label for="title" class="col-sm-2 col-form-label">Name</label>
                              <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $model->title) }}">
                          </div>
                          <div class="col-sm-7">
                              <label for="code" class="col-sm-2 col-form-label">Code</label>
                              <input type="code" class="form-control" id="code" name="code" value="{{ old('code', $model->code) }}">
                          </div>
                      </div>

                      <div class="row mb-3">
                          <div class="col-sm-12 col-md-10">
                              <button type="submit" class="btn btn-success">Update</button>
                          </div>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
