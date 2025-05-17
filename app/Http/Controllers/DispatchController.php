<?php


 namespace App\Http\Controllers;


 use App\Http\Requests\DispatchUpdateRequest;
 use App\Models\Dispatch;
 use App\Models\Flag;
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
         $models = Dispatch::with('user','office','flag')->get();
       return view('backend.website.dispatch.index',compact('models'));
     }

     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
         $users = User::get();
         $offices = Office::pluck('title','id');
         $flags = Flag::pluck('title','id');
         return view('backend.website.dispatch.create',compact('users','offices','flags'));
     }

     /**
      * Store a newly created resource in storage.
      */
     public function store(Request$request)
   {
         $model = new Dispatch();
         $model->flag_id = $request->flag_id;
         $model->user_id = $request->user_id;
         $model->office_id = $request->office_id;
         $model->title = $request->title;
         $model->description = $request->description;
         $model->remark = $request->remark;
       
         $model->dispatch_date = $request->dispatch_date;
         $model->complete_date = $request->complete_date;
    if ($request->hasFile('attachment')) {
    $attachments = [];

    foreach ($request->file('attachment') as $file) {
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('attachments', $filename, 'public');
        $attachments[] = $path;
    }

    $model->attachments = json_encode($attachments); // or use $casts in model
}

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
         $model = Dispatch::find($id);
         $users = User::pluck('name','id');
         $offices = Office::pluck('title','id');
         $flags = Flag::pluck('title','id');
         return view('backend.website.dispatch.edit', compact('model', 'users','offices', 'flags'));
     } 

     /**
      * Update the specified resource in storage.
      */
     public function update(DispatchUpdateRequest $request, string $id)
     {
         $model = Dispatch::find($id);
         $model->flag_id = $request->flag_id;
        $model->user_id = $request->user_id;
         $model->office_id = $request->office_id;
         $model->title = $request->title;
         $model->description = $request->description;
         $model->remark = $request->remark;
        
         $model->dispatch_date = $request->dispatch_date;
        $model->complete_date = $request->complete_date;
  if ($request->hasFile('attachment')) {
    $attachments = [];

    foreach ($request->file('attachment') as $file) {
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('attachments', $filename, 'public');
        $attachments[] = $path;
    }

    $model->attachments = json_encode($attachments); // or use $casts in model
}
         $model->save();

         return redirect()->route('dispatch.index');
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
