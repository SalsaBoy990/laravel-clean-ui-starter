<?php

namespace App\Http\Controllers\Demo\Clean;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;

class DemoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        return view('admin.pages.demo')->with([
            'fruits' => [
                'Apple', 'Banana', 'Watermelon', 'Orange', 'Cherry', 'Blackberry', 'Strawberry', 'Apricot', 'Kiwi',
            ],
        ]);
    }
}
