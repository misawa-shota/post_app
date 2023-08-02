<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $categories = Category::all();
        $prices = Store::distinct('price')->orderByRaw('CAST(price as SIGNED) ASC')->get('price');

        $keyword = $request->input('keyword');
        $category = $request->input('category');
        $price = $request->input('price');

        if (!empty($keyword)) {
            $stores = Store::where('store_name', 'LIKE', "%{$keyword}%");
            $count = $stores->count();
            $stores = $stores->paginate(15);
        } elseif(!empty($category)) {
            $stores = Store::whereHas('categories', function ($query) use ($category){
                $query->where('name', 'LIKE', "$category");
            });
            $count = $stores->count();
            $stores = $stores->paginate(15);
        } elseif(!empty($price)) {
            $stores = Store::where('price', 'LIKE', "$price");
            $count = $stores->count();
            $stores = $stores->paginate(15);
        } else {
            $stores = Store::all();
            $count = $stores->count();
            $stores = Store::paginate(15);
        }

        $stores_star_average = Review::select('store_id')->selectRaw('AVG(star_count) AS star_average')->groupBy('store_id')->get();
        $stores_review_count = Review::select('store_id')->selectRaw('COUNT(id) as count_review')->groupBy('store_id')->get();

        return view('stores.index', compact('stores', 'keyword', 'categories', 'prices', 'count', 'stores_star_average', 'stores_review_count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('stores.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'store_name' => 'required',
            'store_description' => 'required',
            'price' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
        ],[
            'store_name.required' => '店舗名を入力してください。',
            'store_description.required' => '店舗の説明欄を入力してください。',
            'price.required' => '価格帯を入力してください。',
            'postal_code.required' => '郵便番号を入力してください。',
            'address.required' => '住所を入力してください。',
        ]);

        $store = new Store();
        $store->store_name = $request->input('store_name');
        $store->store_description = $request->input('store_description');
        $store->price = $request->input('price');
        $store->postal_code = $request->input('postal_code');
        $store->address = $request->input('address');
        $store->open_time = $request->input('open_time');
        $store->regular_holiday = $request->input('regular_holiday');
        $store->seating_number = $request->input('seating_number');
        $original = request()->file('store_img')->getClientOriginalName();
        $name = date('Ymd_His').'_'.$original;
        request()->file('store_img')->move('img', $name);
        $store->store_img = $name;

        $store->save();

        $store->categories()->sync($request->input('category_ids'));

        return redirect()->route('stores.index')->with('flash_message', '新しい店舗の情報を追加しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
        $reviews = $store->reviews()->get();
        $stores_star_average = Review::select('store_id')->selectRaw('AVG(star_count) AS star_average')->groupBy('store_id')->get();
        $stores_review_count = Review::select('store_id')->selectRaw('COUNT(id) as count_review')->groupBy('store_id')->get();

        return view('stores.show', compact('store', 'reviews', 'stores_star_average', 'stores_review_count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
        $categories = Category::all();
        return view('stores.edit', compact('store', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        //
        $request->validate([
            'store_name' => 'required',
            'store_description' => 'required',
            'price' => 'required',
            'postal_code' => 'required',
            'address' => 'required',
        ],[
            'store_name.required' => '店舗名を入力してください。',
            'store_description.required' => '店舗の説明欄を入力してください。',
            'price.required' => '価格帯を入力してください。',
            'postal_code.required' => '郵便番号を入力してください。',
            'address.required' => '住所を入力してください。',
        ]);

        $original = request()->file('store_img')->getClientOriginalName();
        $name = date('Ymd_His').'_'.$original;
        request()->file('store_img')->move('img', $name);
        $store->store_img = $name;
        $store->store_name = $request->input('store_name');
        $store->store_description = $request->input('store_description');
        $store->price = $request->input('price');
        $store->postal_code = $request->input('postal_code');
        $store->address = $request->input('address');
        $store->open_time = $request->input('open_time');
        $store->regular_holiday = $request->input('regular_holiday');
        $store->seating_number = $request->input('seating_number');
        $store->store_img = $request->input('store_img');
        $store->categories()->sync($request->input('category_ids'));

        $store->update();

        return redirect()->route('stores.show', compact('store'))->with('flash_message', '店舗情報を編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
        $store->delete();

        return redirect()->route('store.index')->with('flash_message', '店舗情報を削除しました。');
    }

    public function favorite(Store $store)
    {
        Auth::user()->togglefavorite($store);

        return back();
    }
}
