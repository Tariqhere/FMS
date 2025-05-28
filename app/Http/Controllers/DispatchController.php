<?php

namespace App\Http\Controllers;

use App\Http\Requests\DispatchRequest;
use App\Http\Requests\DispatchUpdateRequest;
use App\Models\Department;
use App\Models\Dispatch;
use App\Models\DispatchDetails;
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
        $models = Dispatch::with('users', 'office', 'flag', 'folder',)
        ->where('status', 0)
        ->get();
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
         
            $model = new Dispatch();

            $model->flag_id         = $request->flag_id;
            $model->folder_id       = $request->folder_id;
            $model->office_id       = $request->office_id;
            $model->title           = $request->title;
            $model->dispatch_number = $request->dispatch_number;
            $model->file_number     = $request->file_number;
            $model->description     = $request->description;
            $model->date            = $request->date;
            $model->time            = $request->time;
            $model->send_to         = $request->send_to;
            $model->received_from   = $request->received_from;

            $model->save();

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $attachment) {
                    $fileName = 'dispatch_document_' . uniqid() . '.' . $attachment->getClientOriginalExtension();
                    $filePath = $attachment->storeAs('public/documents', $fileName);

                    DispatchDocument::create([
                        'dispatch_id' => $model->id,
                        'file' => str_replace('public/', 'storage/', $filePath)
                    ]);
                }
            }

            if ($request->filled('selected_users')) {
                $model->users()->sync($request->selected_users);
            }

            session()->flash('success', 'Dispatch created successfully!');
            return redirect()->route('dispatch.index');

       
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
            return back()->withInput();
        
    }


    public function edit($id)
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

    public function update(DispatchUpdateRequest $request, $id)
    {
        try {
            $model = Dispatch::find($id);
             $model->flag_id = $request->flag_id;
            $model->folder_id = $request->folder_id;
            $model->office_id = $request->office_id;
            $model->title = $request->title;
            $model->dispatch_number = $request->dispatch_number;
            $model->file_number = $request->file_number;
            $model->description = $request->description;
            $model->date = $request->date;
            $model->time = $request->time;
            $model->send_to = $request->send_to;
            $model->received_from = $request->received_from;
            $model->save();
           
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $attachment) {
                    $fileName = 'dispatch_document_' . uniqid() . '.' . $attachment->getClientOriginalExtension();
                    $filePath = $attachment->move('public/documents/', $fileName);

                    DispatchDocument::create([
                        'dispatch_id' => $model->id,
                        'file' => $filePath
                    ]);
                }
            }

            if ($request->filled('selected_users')) {
                $model->users()->sync($request->selected_users);
            } else {
                $model->users()->sync([]);
            }

            flash()->success('Dispatch updated successfully!');
            return redirect()->route('dispatch.index');
        } catch (\Exception $e) {
            flash()->error('Something went wrong: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function delete($id)
    {
       
            $model = Dispatch::find($id);
            $model->delete();
            $model->save();
            flash()->success('Dispatch deleted successfully!');
            return redirect()->route('dispatch.index');
            flash()->error('Failed to delete dispatch: ' . $e->getMessage());
            return back();
        
    }


    //Assigned to me tasks

      public function pending($id){
        $models = DispatchDetails::with('dispatch', 'dispatch.dispatchDocuments')->OfAssignedToMe()->where('status', 0)->get();
       return view('backend.website.inbox.pending.index', compact('models'));
        
    }

    public function assigned($id){
        $models = DispatchDetails::with('dispatch', 'dispatch.dispatchDocuments')->OfAssignedToMe()->where('status', 1)->get();
       return view('backend.website.inbox.assigned.index', compact('models'));
        
    }
       public function approved($id){
        $models = DispatchDetails::with('dispatch', 'dispatch.dispatchDocuments')->OfAssignedToMe()->where('status', 2)->get();
       return view('backend.website.inbox.approved.index', compact('models'));
        
    }
       public function rejected($id){
        $models = DispatchDetails::with('dispatch', 'dispatch.dispatchDocuments')->OfAssignedToMe()->where('status', 3)->get();
       return view('backend.website.inbox.rejected.index', compact('models'));
        
    }

    public function returned($id){
        $models = DispatchDetails::with('dispatch', 'dispatch.dispatchDocuments')->OfAssignedToMe()->where('status', 4)->get();
       return view('backend.website.inbox.returned.index', compact('models'));
        
    }


}
