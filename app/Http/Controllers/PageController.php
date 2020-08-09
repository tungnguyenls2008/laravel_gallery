<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Gallery;


class PageController extends Controller
{
    public function execute($alias) {

        if(!$alias) {
            abort(404);
        }
        $page = Page::where('alias', strip_tags($alias))->first();
        $galleries = Gallery::all();
        if ((view()->exists('site.page')) && (!empty($page))) {
            $data = [
                'title' => $page->name,
                'page' => $page
            ];
            return view('site.page', compact('page', 'galleries'));
        } else {
            abort(404);
        }
    }
}
