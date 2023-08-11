<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Http\Request;


class WebController extends Controller
{
    //
    public function index()
    {
        $review_table = Review::select('store_id')->selectRaw('AVG(star_count) AS star_average')->groupBy('store_id');
        $stores = Store::select("*")
        ->leftJoinSub($review_table, 'reviews', function($query){
            $query->on('stores.id', '=', 'reviews.store_id');
        })
        ->orderBy('star_average', 'desc')
        ->limit('6')
        ->get();

        $stores_star_average = Review::select('store_id')->selectRaw('AVG(star_count) AS star_average')->groupBy('store_id')->get();
        $stores_review_count = Review::select('store_id')->selectRaw('COUNT(id) AS count_review')->groupBy('store_id')->get();

        $new_stores = Store::select("*")->orderBy('updated_at', 'desc')->limit('6')->get();

        return view('web.index', compact('stores', 'stores_star_average', 'stores_review_count', 'new_stores'));
    }
}
