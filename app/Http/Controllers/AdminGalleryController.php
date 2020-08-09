<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use Validator;

class AdminGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(view()->exists('admin.galleryIndex')) {
            $galleries = Gallery::paginate(10);
            $data = [
                'title' => 'Gallery list',
                'galleries' => $galleries
            ];
            return view('admin.galleryIndex', $data);
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
        if(view()->exists('admin.galleryCreate')) {

            $data = [
                'title' => 'Create new Gallery'
            ];
            return view('admin.galleryCreate', $data);
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
            'image' => 'required|image'
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('galleries.create')->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $input['image'] = $file->getClientOriginalName();
            $file->move(public_path().'/img/gallery', $input['image']);
        }

        $gallery = new Gallery();
        $gallery->fill($input);

        if($gallery->save()) {
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
    public function edit(Gallery $gallery)
    {
        $old = $gallery->toArray();
        if(view()->exists('admin.galleryEdit')) {

            $data = [
                'title' => 'Update Gallery content - '.$old['name'],
                'data' => $old
            ];

            return view('admin.galleryEdit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $input = $request->except('_token');
        $validator = Validator::make($input,[
            'name' => 'required|max:255',
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('galleries.edit', ['gallery' => $input['id']])->withErrors($validator)->withInput();
        }


        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file->move(public_path().'/img/gallery', $file->getClientOriginalName());
            $input['image'] = $file->getClientOriginalName();

        } else {
            $input['image'] = $input['old_image'];
        }

        unset($input['old_image']);

        $gallery->fill($input);

        if($gallery->update()) {
            return redirect('admin')->with('success', 'Gallery content updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        if ($gallery) {
            return redirect()
                ->route('galleries.index')
                ->with(['success' => 'Gallery Deleted']);
        } else {
            return back()
                ->withErrors(['msg' => 'Error, Unable to delete']);

        }
    }
}
