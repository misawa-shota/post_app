<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\MOdels\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stores = Store::all();
        return view('stores.index', compact('stores'));
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
        return view('stores.show', compact('store'));
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

        $store->store_name = $request->input('store_name');
        $store->store_description = $request->input('store_description');
        $store->price = $request->input('price');
        $store->postal_code = $request->input('postal_code');
        $store->address = $request->input('address');
        $store->open_time = $request->input('open_time');
        $store->regular_holiday = $request->input('regular_holiday');
        $store->seating_number = $request->input('seating_number');
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
}
