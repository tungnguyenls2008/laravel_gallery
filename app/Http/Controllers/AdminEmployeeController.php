<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Validator;


class AdminEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(view()->exists('admin.employeeIndex')) {
            $employees = Employee::all();
            $data = [
                'title' => 'Contact List',
                'employees' => $employees
            ];
            return view('admin.employeeIndex', $data);
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
        if(view()->exists('admin.employeeCreate')) {

            $data = [
                'title' => 'New Contact'
            ];
            return view('admin.employeeCreate', $data);
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
            'position' => 'required|max:255',
            'text' => 'required|max:255',
            'instagram_link' => 'required|max:255',
            'images' => 'required|image'
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('employees.create')->withErrors($validator)->withInput();
        }

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $input['images'] = $file->getClientOriginalName();
            $file->move(public_path().'/img/gallery', $input['images']);
        }

        $employee = new Employee();
        $employee->fill($input);

        if($employee->save()) {
            return redirect('admin')->with('success', 'Успешно добавлено');
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
    public function edit(Employee $employee)
    {
        $old = $employee->toArray();
        if(view()->exists('admin.employeeEdit')) {

            $data = [
                'title' => 'Update Contact - '.$old['name'],
                'data' => $old
            ];

            return view('admin.employeeEdit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $input = $request->except('_token');
        $validator = Validator::make($input,[
            'name' => 'required|max:255',
            'position' => 'required|max:255',
            'text' => 'required|max:255',
            'instagram_link' => 'required|max:255'
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('employees.edit', ['employee' => $input['id']])->withErrors($validator)->withInput();
        }


        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $file->move(public_path().'/img', $file->getClientOriginalName());
            $input['images'] = $file->getClientOriginalName();

        } else {
            $input['images'] = $input['old_images'];
        }

        unset($input['old_images']);

        $employee->fill($input);

        if($employee->update()) {
            return redirect('admin')->with('success', 'Данные сотрудника обновлены');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        if ($employee) {
            return redirect()
                ->route('employees.index')
                ->with(['success' => 'Contact Deleted']);
        } else {
            return back()
                ->withErrors(['msg' => 'Error, Unable to Delete']);

        }
    }
}
