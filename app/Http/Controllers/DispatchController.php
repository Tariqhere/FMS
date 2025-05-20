<?php

namespace App\Http\Controllers;

use App\Http\Requests\DispatchRequest;
use App\Http\Requests\DispatchUpdateRequest;
use App\Models\Dispatch;
use App\Models\Dispatch_document;
use App\Models\DispatchDocument;
use App\Models\Flag;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Dispatch::with('user', 'office', 'flag')->get();
        return view('backend.website.dispatch.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::get();
        $offices = Office::pluck('title', 'id');
        $flags = Flag::pluck('title', 'id');
        return view('backend.website.dispatch.create', compact('users', 'offices', 'flags'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(DispatchRequest $request)
{
    $dispatch = new Dispatch();
    $dispatch->flag_id = $request->flag_id;
    $dispatch->user_id = $request->user_id;
    $dispatch->office_id = $request->office_id;
    $dispatch->title = $request->title;
    $dispatch->description = $request->description;
    $dispatch->remark = $request->remark;
    $dispatch->dispatch_date = $request->dispatch_date;
    $dispatch->complete_date = $request->complete_date;

    $dispatch->save(); // ✅ پہلے save کریں

    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            if ($file->isValid()) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('attachments', $filename, 'public');

                DispatchDocument::create([
                    'dispatch_id' => $dispatch->id,
                    'title' => $file->getClientOriginalName(),
                    'file' => $path,
                    'status' => 0
                ]);
            }
        }
    }

    return redirect()->route('dispatch.index')->with('success', 'Dispatch created successfully');
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Dispatch::with('documents')->findOrFail($id);
        $users = User::pluck('name', 'id');
        $offices = Office::pluck('title', 'id');
        $flags = Flag::pluck('title', 'id');
        return view('backend.website.dispatch.edit', compact('model', 'users', 'offices', 'flags'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(DispatchUpdateRequest $request, $id)
{
    try {
        $dispatch = Dispatch::findOrFail($id);
        $dispatch->flag_id = $request->flag_id;
        $dispatch->user_id = $request->user_id;
        $dispatch->office_id = $request->office_id;
        $dispatch->title = $request->title;
        $dispatch->description = $request->description;
        $dispatch->remark = $request->remark;
        $dispatch->dispatch_date = $request->dispatch_date;
        $dispatch->complete_date = $request->complete_date;
        $dispatch->save();

        // Handle new attachments
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file->isValid()) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('attachments', $filename, 'public');

                    DispatchDocument::create([
                        'dispatch_id' => $dispatch->id,
                        'title' => $file->getClientOriginalName(),
                        'file' => $path,
                        'status' => 0
                    ]);
                }
            }
        }

        return redirect()->route('dispatch.index')->with('success', 'Dispatch updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->withErrors(['error' => 'Error while updating: ' . $e->getMessage()]);
     }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $dispatch = Dispatch::find($id);
        
        // Delete associated documents and their files
        foreach ($dispatch->documents as $document) {
            Storage::disk('public')->delete($document->file);
            $document->delete();
        }
        
        $dispatch->delete();
        
        return redirect()->route('dispatch.index')->with('success', 'Dispatch deleted successfully');
    }
}