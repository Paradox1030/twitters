<?php

namespace App\Http\Controllers;

use App\Events\MessagesInsert;
use App\Models\Twitters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TwittersController extends Controller
{
    public function insert(Request $request)
    {
        $categoryId = $request->input('categoryId');
        $userName = $request->input('userName');
        $content = $request->input('content');

        if ($categoryId && $userName && $content) {

//            $twitters = new Twitters();
//            $twitters->categoryId = $categoryId;
//            $twitters->content = $content;
//            $twitters->userName = $userName;

            $twitters = [
                'categoryId' => $categoryId,
                'content' => $content,
                'userName' => $userName,
            ];

            event(new MessagesInsert($twitters));

            return response()->json(['result' => true]);
        } else {
            return response()->json(['result' => 'error']);
        }
    }

    public function getTwitters()
    {
        $twitters = DB::table('twitters')->join('categories', 'twitters.categoryId', '=', 'categories.id')->get(['categories.title', 'twitters.userName', 'twitters.content', 'twitters.created_at']);
        return response()->json(['result' => $twitters]);
    }
}


