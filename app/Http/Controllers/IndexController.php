<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\Portfolio;
use App\Employee;
use App\Service;
use Illuminate\Support\Facades\Mail;


class IndexController extends Controller
{
    public function execute() {

        $pages = Page::all();
        $portfolios = Portfolio::get(['name', 'filter', 'images']);
        $services = Service::all();
        $employees = Employee::all();

        $tags = Portfolio::distinct()->pluck('filter');

        $menu = [];
        foreach ($pages as $page) {
            $item = [
                'title' => $page->name,
                'alias' => $page->alias,
            ];
            array_push($menu, $item);
        }
        $item = ['title' => 'Service', 'alias' => 'service'];
        array_push($menu, $item);

        $item = ['title' => 'Portfolio', 'alias' => 'Portfolio'];
        array_push($menu, $item);

        $item = ['title' => 'Team', 'alias' => 'team'];
        array_push($menu, $item);

        $item = ['title' => 'Contact', 'alias' => 'contact'];
        array_push($menu, $item);

        return view('site.index', compact('menu', 'pages', 'services', 'portfolios', 'employees', 'tags'));
    }

    public  function sendmail(Request $request) {

        $messages = [
                'required' => "This field is required" ,
                'email' => "Email miss-matched"
               ];

        $this->validate($request,
                [
                    'name' =>'required|max:255',
                    'phone'=>'required',
                    'email'=>'required|email',
                    'text'=>'required'
                ], $messages);

        $data = $request->all();

        Mail::send('site.email', ['data'=>$data], function($message) use ($data) {

                $mailAdmin = env('MAIL_ADMIN');

                $message->from($data['email'], $data['name']);

                $message->to($mailAdmin)->subject('Question');
            });

        return redirect()
            ->route('home')
            ->with('success', 'Email sent successfully');;
    }
}
