@extends('backend.layout.auth')

@section('backend')


    <!-- Hoverable Table rows -->
    <div class="card ms-4 me-4">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col-6">
                    <h5 class="card-header">Dispatch Index</h5>
                </div>
                <div class="col-6 text-end">
                    <a href="{{ route('dispatch.create') }}" class="btn btn-primary btn-sm me-3">Create</a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>S#</th>
                            <th>Title</th>
                            <th>Description</th>  
                            <th>Remark</th>   
                            <th>Attachment</th>
                            <th>Flag</th>
                            <th>Office</th>
                            <th>User</th>
                            <th>Dispatch_date</th>
                            <th>Complete_date</th>
                            <th>States</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($models as $model)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $model->title ?? 'NA' }}</td>
                                <td>{{ $model->description ?? 'NA' }}</td>
                                <td>{{ $model->remark ?? 'NA' }}</td> 
                                 <td>
                                @if(is_array($model->attachment))
                                    <ul class="list-unstyled mb-0">
                                        @foreach($model->attachment as $file)
                                            <li>
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ basename($file) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @elseif(is_string($model->attachment) && json_decode($model->attachment))
                                    <ul class="list-unstyled mb-0">
                                        @foreach(json_decode($model->attachment) as $file)
                                            <li>
                                                <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ basename($file) }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    NA
                                @endif
                            </td>
                                <td>{{ $model->flag->title ?? 'NA' }}</td>
                                <td>{{ $model->office->title ?? 'NA' }}</td>
                                <td>{{ $model->user->name ?? 'NA' }}</td>
                                <td>{{ $model->dispatch_date ?? 'NA' }}</td>
                                <td>{{ $model->complete_date ?? 'NA' }}</td>
                                <td>{{ $model->status ?? 'NA' }}</td>
                                <td class="text-center">
                        <div class="d-flex justify-content-center gap-3">
                          <!-- Edit Button -->
                          <a href="{{ route('dispatch.edit', $model->id) }}" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                          </a>

                          <!-- Delete Button with Confirmation -->
                           <a href="{{ route('dispatch.delete', $model->id) }}" title="Delete" style="color: #dc3545;">
                              <i class="bi bi-trash"></i>
                            </a>
                        </div>
                      </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center"><strong>No records found...</strong></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection 
