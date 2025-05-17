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
                    <h3 class="font-weight-bold">Flag Index</h3>
                  </div>
                  <div class="col-auto text-end">
                    <a href="{{ route('flag.create') }}" class="btn btn-success btn-sm rounded-pill" style="font-size: 8px;">
                      <i class="fa fa-plus"></i> Create New
                    </a>
                  </div>
                </div>
              </div>
              <!-- /Table Header -->

              <div class="table-responsive">
                <table class="table table-striped table-hover custom-table">
                  <thead class="thead-dark">
                    <tr>
                      <th class="text-center">S#</th>
                      <th>Title</th>
                      <th>Code</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($models as $model)
                    <tr>
                      <td class="text-center">{{ $loop->iteration }}</td>
                      <td>{{ $model->title ?? 'NA' }}</td>
                      <td>{{ $model->code ?? 'NA' }}</td>
                      <td class="text-center">
                        <span class="badge bg-success">Active</span>
                      </td>
                      <td class="text-center">
                        <div class="d-flex justify-content-center gap-3">
                          <!-- Edit Button -->
                          <a href="{{ route('flag.edit', $model->id) }}" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                          </a>

                          <!-- Delete Button with Confirmation -->
                         <a href="{{ route('flag.delete', $model->id) }}" title="Delete" style="color: #dc3545;">
                               <i class="bi bi-trash"></i>
                             </a>

                        </div>
                      </td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="5" class="text-center"><strong>No records found...</strong></td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
