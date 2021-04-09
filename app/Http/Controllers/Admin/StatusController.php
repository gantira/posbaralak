<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Status/Index', [
            'statuses' => Status::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Status/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:statuses,name',
            'description' => 'required|min:3',
        ]);

        Status::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        session()->flash('message', 'Status created succesfully.');
        session()->flash('type', 'success');

        return redirect(route('admin.statuses.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return Inertia::render('Admin/Status/Edit', [
            'status' => $status
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $request->validate([
            'name' => 'required|unique:statuses,name,' . $status->id,
            'description' => 'required|min:3',
        ]);

        $status->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        session()->flash('message', 'Status has been updated.');
        session()->flash('type', 'info');

        return redirect(route('admin.statuses.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        $status->delete();

        session()->flash('message', 'Status has been deleted.');
        session()->flash('type', 'info');

        return redirect(route('admin.statuses.index'));
    }
}
