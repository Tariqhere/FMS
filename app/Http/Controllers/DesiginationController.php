<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesiginationRequest;
use App\Http\Requests\DesiginationUpdateRequest;
use App\Models\Desigination;


class DesiginationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $models = Desigination::all();
         return view('backend.website.primary_setting.desigination.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.website.primary_setting.desigination.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DesiginationRequest $request)
    {
        $model = new Desigination();
        $model->name = $request->name;
        $model->code = $request->code;
   
        $model->save();
        return redirect()->route('desigination.index');
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
        $model =Desigination::find($id);
        return view('backend.website.primary_setting.desigination.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DesiginationUpdateRequest $request, string $id)
    {
       $model =Desigination::find($id);
        $model->title = $request->title;
        $model->code = $request->code;
        $model->save();
        return redirect('desigination.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $model=Desigination::find($id);
        $model->delete();
        return redirect(route('desigination.index'));
    }
}
