<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Page;

class PagesEditController extends Controller
{
    public function execute(Request $request, Page $page) {

        if($request->isMethod('delete')){
            $page->delete();
            return redirect('admin')
               ->with('success', 'Page deleted');;
        }


        if($request->isMethod('post')){

            $input = $request->except('_token', '_method');

            $validator = Validator::make($input,[
                'name'=>'required|max:255',
                'alias'=>'required|max:255|unique:pages,alias,'.request()->route('page')->id,
                'text'=>'required'
            ]);

            if($validator->fails()) {
                return redirect()
                    ->route('pagesEdit', ['page' => $input['id']])->withErrors($validator)->withInput();
            }


            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $file->move(public_path().'/img', $file->getClientOriginalName());
             $input['images'] = $file->getClientOriginalName();

            } else {
                $input['images'] = $input['old_images'];
            }

            unset($input['old_images']);

            $page->fill($input);

            if($page->update()) {
                return redirect('admin')->with('success', 'Page updated');
            }
        }

        $old = $page->toArray();
        if(view()->exists('admin.pages_edit')) {

            $data = [
                    'title' => 'Update this page - '.$old['name'],
                    'data' => $old
                    ];

            return view('admin.pages_edit', $data);
        }
    }
}
