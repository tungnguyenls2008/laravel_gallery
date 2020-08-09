<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use Validator;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(view()->exists('admin.serviceIndex')) {
            $services = Service::all();
            $data = [
                'title' => 'Service List',
                'services' => $services
            ];
            return view('admin.serviceIndex', $data);
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(view()->exists('admin.serviceCreate')) {

            $data = [
                'title' => 'Create new Service'
            ];
            return view('admin.serviceCreate', $data);
        }

        abort(404);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token');
        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'text' => 'required|max:255',
            'icon' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('services.create')->withErrors($validator)->withInput();
        }

        $service = new Service();
        $service->fill($input);

        if($service->save()) {
            return redirect('admin')->with('success', 'Service created successfully');
        }
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
    public function edit(Service $service)
    {
        $old = $service->toArray();
        if(view()->exists('admin.serviceEdit')) {

            $data = [
                'title' => 'Update service - '.$old['name'],
                'data' => $old
            ];

            return view('admin.serviceEdit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $input = $request->except('_token');
        $validator = Validator::make($input,[
            'name' => 'required|max:255',
            'text' => 'required|max:255',
            'icon' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('services.edit', ['service' => $input['id']])->withErrors($validator)->withInput();
        }

        $service->fill($input);

        if($service->update()) {
            return redirect('admin')->with('success', 'Service updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();

        if ($service) {
            return redirect()
                ->route('services.index')
                ->with(['success' => 'Service deleted successfully']);
        } else {
            return back()
                ->withErrors(['msg' => 'Error, Unable to delete']);

        }
    }
}
