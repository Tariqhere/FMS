<?php

namespace App\Http\Controllers;

use App\Http\Requests\DispatchRequest;
use App\Http\Requests\DispatchUpdateRequest;
use App\Models\Department;
use App\Models\Dispatch;
use App\Models\DispatchDocument;
use App\Models\Flag;
use App\Models\Folder;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class DispatchController extends Controller
{
    public function index()
    {
        $models = Dispatch::with('users', 'office', 'flag', 'folder')->get();
        return view('backend.website.dispatch.index', compact('models'));
    }

    public function create()
    {
        $flags = Flag::pluck('title', 'id');
        $offices = Office::pluck('title', 'id');
        $departments = Department::pluck('name', 'id');
        $folders = Folder::pluck('title', 'id');

        $users = User::select('id', 'name', 'cnic', 'contact', 'office_id', 'department_id')
            ->with(['office:id,title', 'department:id,name'])
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name ?? 'N/A',
                    'cnic' => $user->cnic ?? 'N/A',
                    'contact' => $user->contact ?? 'N/A',
                    'office_id' => $user->office_id,
                    'department_id' => $user->department_id,
                    'office' => $user->office ? ['title' => $user->office->title ?? 'N/A'] : null,
                    'department' => $user->department ? ['name' => $user->department->name ?? 'N/A'] : null,
                ];
            });

        return view('backend.website.dispatch.create', compact('flags', 'offices', 'departments', 'folders', 'users'));
    }

    public function store(DispatchRequest $request)
    {
        try {
            $model = new Dispatch();
            $model->flag_id = $request->flag_id;
            $model->folder_id = $request->folder_id;
            $model->office_id = $request->office_id;
            $model->title = $request->title;
            $model->dispatch_number = $request->dispatch_number;
            $model->file_number = $request->file_number;
            $model->description = $request->description;
            $model->date = $request->date;
            $model->dispatch_time = $request->dispatch_time;
            $model->send_to = $request->send_to;
            $model->received_from = $request->received_from;
            $model->save();

            // Handle attachments
            if ($request->hasFile('attachments')) {
                foreach ($request->attachments as $attachment) {
                    $file_name = 'dispatch_document_' . uniqid() . '.' . $attachment->getClientOriginalExtension();
                    $file_path = $attachment->move('public/documents/', $file_name);
                    $document = new DispatchDocument();
                    $document->dispatch_id = $model->id;
                    $document->file = $file_path;
                    $document->save();
                }
            }

            // Handle selected users
            if ($request->filled('selected_users') && is_array($request->selected_users)) {
                $model->users()->sync($request->selected_users);
            }

            flash()->success('Dispatch created successfully!');
            return redirect()->route('dispatch.index');
        } catch (\Exception $e) {
            flash()->error('Something went wrong: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function show(Dispatch $dispatch)
    {
        $flags = Flag::pluck('title', 'id');
        $offices = Office::pluck('title', 'id');
        $departments = Department::pluck('name', 'id');
        $folders = Folder::pluck('title', 'id');

        $model = $dispatch->load('users');
        $model->users = $model->users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name ?? 'N/A',
                'cnic' => $user->cnic ?? 'N/A',
                'contact' => $user->contact ?? 'N/A',
                'office_id' => $user->office_id,
                'department_id' => $user->department_id,
                'office_name' => $user->office->title ?? 'N/A',
                'department_name' => $user->department->name ?? 'N/A',
                'email' => $user->email ?? 'N/A',
            ];
        });

        $users = User::select('id', 'name', 'cnic', 'contact', 'office_id', 'department_id')
            ->with(['office:id,title', 'department:id,name'])
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name ?? 'N/A',
                    'cnic' => $user->cnic ?? 'N/A',
                    'contact' => $user->contact ?? 'N/A',
                    'office_id' => $user->office_id,
                    'department_id' => $user->department_id,
                    'office' => $user->office ? ['title' => $user->office->title ?? 'N/A'] : null,
                    'department' => $user->department ? ['name' => $user->department->name ?? 'N/A'] : null,
                ];
            });

        return view('backend.website.dispatch.show', compact('model', 'flags', 'offices', 'departments', 'folders', 'users'));
    }

    public function edit(string $id)
    {
        $model = Dispatch::findOrFail($id);
        $flags = Flag::pluck('title', 'id');
        $offices = Office::pluck('title', 'id');
        $departments = Department::pluck('name', 'id');
        $folders = Folder::pluck('title', 'id');

        $users = User::select('id', 'name', 'cnic', 'contact', 'office_id', 'department_id')
            ->with(['office:id,title', 'department:id,name'])
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name ?? 'N/A',
                    'cnic' => $user->cnic ?? 'N/A',
                    'contact' => $user->contact ?? 'N/A',
                    'office_id' => $user->office_id,
                    'department_id' => $user->department_id,
                    'office' => $user->office ? ['title' => $user->office->title ?? 'N/A'] : null,
                    'department' => $user->department ? ['name' => $user->department->name ?? 'N/A'] : null,
                ];
            });

        return view('backend.website.dispatch.edit', compact('model', 'flags', 'offices', 'departments', 'folders', 'users'));
    }

    public function update(DispatchUpdateRequest $request, string $id)
    {
        try {
            $model = Dispatch::findOrFail($id);
            $model->flag_id = $request->flag_id;
            $model->folder_id = $request->folder_id;
            $model->office_id = $request->office_id;
            $model->title = $request->title;
            $model->dispatch_number = $request->dispatch_number;
            $model->file_number = $request->file_number;
            $model->description = $request->description;
            $model->dispatch_date = $request->dispatch_date;
            $model->complete_date = $request->complete_date;
            $model->dispatch_time = $request->dispatch_time;
            $model->send_to = $request->send_to;
            $model->received_from = $request->received_from;
            $model->save();

            if ($request->hasFile('attachments')) {
                foreach ($request->attachments as $attachment) {
                    $file_name = 'dispatch_document_' . uniqid() . '.' . $attachment->getClientOriginalExtension();
                    $file_path = $attachment->move('public/documents/', $file_name);
                    $document = new DispatchDocument();
                    $document->dispatch_id = $model->id;
                    $document->file = $file_path;
                    $document->save();
                }
            }

            if ($request->filled('selected_users') && is_array($request->selected_users)) {
                $model->users()->sync($request->selected_users);
            } else {
                $model->users()->sync([]);
            }
            return redirect()->route('dispatch.index')->with('success',' added successfully');
        } catch (\Exception $e) {
            flash()->error('Something went wrong: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function delete(string $id)
    {
        try {
            $model = Dispatch::findOrFail($id);
            $model->delete();
            return redirect()->route('dispatch.index')->with('success',' added successfully');
        } catch (\Exception $e) {
            flash()->error('Failed to delete dispatch: ' . $e->getMessage());
            return back();
        }
    }
}
