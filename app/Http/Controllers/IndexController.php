<?php

declare(strict_types = 1);

namespace App\Http\Controllers;


use App\Models\Categories;
use App\Models\Twitters;
use Illuminate\Support\Facades\DB;

class IndexController extends AbstractController
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $category = Categories::all();
        $twitters = DB::table('twitters')->join('categories','twitters.categoryId','=','categories.id')->get(['categories.title','twitters.userName','twitters.content','twitters.created_at']);
        return view('index', [
            'category' => $category,
            'twitters' => $twitters
        ]);
    }
}
