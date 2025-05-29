@extends('backend.layout.auth')

@section('backend')
    <div class="content-wrapper">
        <section class="section ms-4 me-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pending Dispatches</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Office</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($dispatches as $dispatch)
                                <tr>
                                    <td>{{ $dispatch->title }}</td>
                                    <td>{{ $dispatch->office->name ?? 'N/A' }}</td>
                                    <td>{{ $dispatch->user->name ?? 'N/A' }}</td>
                                    <td>
                                        <form action="{{ route('dispatch.accept', $dispatch->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                        </form>
                                        <form action="{{ route('dispatch.reject', $dispatch->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

