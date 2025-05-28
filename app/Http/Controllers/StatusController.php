<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use Illuminate\Http\Request;
use App\Models\DispatchDetails;
use Illuminate\Database\Eloquent\Model;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
          public function assigned($id){
        $models = DispatchDetails::with('dispatch', 'dispatch.dispatchDocuments')->OfAssignedToMe()->where('status', 1)->get();
       return view('backend.website.inbox.assigned.index', compact('models'));
        
    }

        public function getAssignedStatus($id){

            $models = Dispatch::find($id);
            $models -> status = 1;
            $done = $models->save();
            return back();

        }
    
 
        public function getApprovedStatus($id){

            $models = Dispatch::find($id);
            $models -> status = 2;
            $done = $models->save();
            return back();

        }

   public function getReturnedStatus($id){

            $models = Dispatch::find($id);
            $models -> status = 3;
            $done = $models->save();
            return back();

        }
         public function getRejectedStatus($id){

            $models = Dispatch::find($id);
            $models -> status = 4;
            $done = $models->save();
            return back();

        }

         public function getSendStatus($id){

            $models = Dispatch::find($id);
            $models -> status = 5;
            $done = $models->save();
            return back();

        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
