<?php

namespace App\Http\Controllers;

use App\Http\Requests\DispatchRequest;
use App\Http\Requests\DispatchUpdateRequest;
use App\Models\Dispatch;
use App\Models\Flag;
use App\Models\Folder;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

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
        $model = new Dispatch();
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
        return redirect()->route('dispatch.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model= Dispatch::find($id);
        $users = User::pluck('name', 'id');
        $flags = Flag::pluck('title', 'id');
        $offices = Office::pluck('title', 'id');
        $folders = Folder::pluck('title', 'id');
        return view('backend.website.dispatch.edit', compact('model', "users",'offices','folders', 'flags'));
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(DispatchUpdateRequest $request, string $id)
//    {
////        $request->validate([
////            'title'            => 'required|string|max:255',
////            'folder_id'        => 'required|integer|exists:folders,id',
////            'flag_id'          => 'required|integer|exists:flags,id',
////            'dispatch_number'  => 'required|string|max:100',
////            'file_number'      => 'required|string|max:100|',
////            'dispatch_date'    => 'nullable|date',
////            'complete_date'    => 'nullable|date|after_or_equal:dispatch_date',
////            'office_id'        => 'required|integer|exists:offices,id',
////            'send_to'          => 'required|string|max:255',
////            'received_from'    => 'required|string|max:255',
////            'dispatch_time'    => 'required|date_format:H:i',
////            'description'      => 'nullable|string',
////        ]);
//        try {
//            $model = Dispatch::find($id);
//            $model->flag_id = $request->flag_id;
//            $model->folder_id = $request->folder_id;
//            $model->office_id = $request->office_id;
//            $model->title = $request->title;
//            $model->dispatch_number = $request->dispatch_number;
//            $model->file_number = $request->file_number;
//            $model->description = $request->description;
//            $model->dispatch_date = $request->dispatch_date;
//            $model->complete_date = $request->complete_date;
//            $model->dispatch_time = $request->dispatch_time;
//            $model->send_to = $request->send_to;
//            $model->received_from = $request->received_from;
//
//        }catch (\Exception $exception){
////            dd($exception);
//        } finally {
//            $done = $model->save();
//        }
//        if(!$done){
//            return back()->withErrors([$model]);
//        }
//        return redirect()->route('dispatch.index');
//    }
    public function update(Request $request, string $id)
    {
        try {
            $model = Dispatch::find($id);
            $model->flag_id = $request->flag_id;
            $model->folder_id = $request->folder_id;
            $model->office_id = $request->office_id;
            $model->user_id = $request->user_id; // Added from view
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
            return redirect()->route('dispatch.index')->with('success', 'Dispatch updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to update dispatch:', ['id' => $id, 'error' => $e->getMessage()]);
            return back()->with('error', 'Failed to update dispatch: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $model = Dispatch::find($id);
        $model->delete();
        // Redirect with a success message
        return redirect()->route('dispatch.index');
    }
}
