<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Page;

class PagesAddController extends Controller
{
    public function execute(Request $request) {

        if($request->isMethod('POST')) {
            $input = $request->except('_token', '_method');

            $massages = [
                'required'=>'This field is required',
                'unique' => 'This field must be unique'
            ];

            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'alias'=> 'required|unique:pages|max:255',
                'text' => 'required'
            ], $massages);

            if($validator->fails()) {
                return redirect()
                    ->route('pagesAdd')->withErrors($validator)->withInput();
            }

            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path().'/img', $input['images']);
            }

            $page = new Page();
            $page->fill($input);

            if($page->save()) {
                return redirect('admin')->with('success', 'Page added');
            }
        }

        if(view()->exists('admin.pages_add')) {

            $data = [
                'title' => 'New Page'
            ];
            return view('admin.pages_add', $data);
        }

        abort(404);
    }
}
