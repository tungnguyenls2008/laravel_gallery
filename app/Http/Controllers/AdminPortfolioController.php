<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use Validator;

class AdminPortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(view()->exists('admin.portfolioIndex')) {
        $portfolios = Portfolio::all();
            $data = [
                'title' => 'Portfolio list',
                'portfolios' => $portfolios
            ];
        return view('admin.portfolioIndex', $data);
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
        if(view()->exists('admin.portfolioCreate')) {

            $data = [
                'title' => 'Новый элемент портфолио'
            ];
            return view('admin.portfolioCreate', $data);
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
                'filter'=> 'required|max:255',
                'images' => 'required'
            ]);

            if($validator->fails()) {
                return redirect()
                    ->route('portfolios.create')->withErrors($validator)->withInput();
            }

            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $input['images'] = $file->getClientOriginalName();
                $file->move(public_path().'/img', $input['images']);
            }

            $portfolio = new Portfolio();
            $portfolio->fill($input);

            if($portfolio->save()) {
                return redirect('admin')->with('success', 'Portfolio successfully created');
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
    public function edit(Portfolio $portfolio)
    {
        $old = $portfolio->toArray();
        if(view()->exists('admin.portfolioEdit')) {

            $data = [
                'title' => 'Update Portfolio - '.$old['name'],
                'data' => $old
            ];

            return view('admin.portfolioEdit', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        $input = $request->except('_token');
        $validator = Validator::make($input,[
            'name' => 'required|max:255',
            'filter'=> 'required|max:255',
        ]);

        if($validator->fails()) {
            return redirect()
                ->route('portfolios.edit', ['portfolio' => $input['id']])->withErrors($validator)->withInput();
        }


        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $file->move(public_path().'/img', $file->getClientOriginalName());
            $input['images'] = $file->getClientOriginalName();

        } else {
            $input['images'] = $input['old_images'];
        }

        unset($input['old_images']);

        $portfolio->fill($input);

        if($portfolio->update()) {
            return redirect('admin')->with('success', 'Portfolio content updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        if ($portfolio) {
            return redirect()
                ->route('portfolios.index')
                ->with(['success' => 'Portfolio deleted successfully']);
        } else {
            return back()
                ->withErrors(['msg' => 'Error, Unable to delete']);

        }
    }
}
