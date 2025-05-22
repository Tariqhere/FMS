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
                        <th>Folders</th>
                        <th>Dipatch Number</th>
                        <th>file Number</th>
                        <th>Flags</th>
                        <th>Office</th>
                        <th>Dispatch Date</th>
                        <th>Complete Date</th>
                        <th>Dispatch Time</th>
                        <th>Received From</th>
                        <th>Send To</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($models as $model)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $model->title ?? 'NA' }}</td>
                            <td>{{ $model->folder->title ?? 'NA' }}</td>
                            <td>{{ $model->dispatch_number ?? 'NA' }}</td>
                            <td>{{ $model->file_number ?? 'NA' }}</td>
                            <td>{{ $model->flag->title ?? 'NA' }}</td>
                            <td>{{$model->office->title ?? 'NA'}}</td>
                            <td>{{ $model->dispatch_date ?? 'NA' }}</td>
                            <td>{{ $model->complete_date ?? 'NA' }}</td>
                            <td>{{ $model->dispatch_time ? \Carbon\Carbon::createFromFormat('H:i:s', $model->dispatch_time)->format('h:i A') : 'NA' }}</td>
                            <td>{{ $model->received_from?? 'NA' }}</td>
                             <td>{{ $model->send_to ?? 'NA' }}</td>
                            <td>{{ strip_tags($model->description) ?? 'N/A' }}</td>
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
                            <td colspan="13" class="text-center"><strong>No records found...</strong></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
