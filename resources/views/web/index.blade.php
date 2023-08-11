@extends('layouts.app')

@section('content')
    <div class="swiper">
        <div class="catch_flase">
            <h2 class="text-white fs-1">
                名古屋ならではの味を、<br>
                見つけよう
            </h2>
            <p class="text-white">
                Nagoyameshiは、<br>
                名古屋市のB級グルメ専門のレビューサイトです。
            </p>
        </div>
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="{{ asset('img/ra-men.jpg') }}" alt="ラーメンの画像" class="w-100"></div>
            <div class="swiper-slide"><img src="{{ asset('img/tonkatu.jpg') }}" alt="とんかつの画像" class="w-100"></div>
            <div class="swiper-slide"><img src="{{ asset('img/niku.jpg') }}" alt="焼肉の画像" class="w-100"></div>
        </div>
    </div>
    <div class="index_area">
        <div class="container">
            <div class="col-3 py-5">
                <h2>店舗名から探す</h2>
                <form action="{{ route('stores.index') }}" action="get">
                    <div class="input-group">
                        <input type="text" name="keyword" placeholder="店舗名" class="form-control w-75">
                        <button type="submit" class="btn btn-primary">検索</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div>

    </div>
    <div class="container">
        <div class="row my-5">
            <h3>評価が高いお店</h3>
            <div class="row">
                @foreach ($stores as $store)
                <div class="col">
                    <a href="{{ route('stores.show', $store->id) }}" class="text-decoration-none toppage_card">
                        <div class="card h-100">
                            <div class="overflow-hidden card_img_top_size">
                                <img src="{{ asset('img/'. $store->store_img) }}" alt="店舗の画像" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $store->store_name }}</h3>
                                @foreach ($store->categories()->orderBy('id', 'asc')->get() as $category)
                                    <span>{{ $category->name }}</span>
                                @endforeach
                                <div>
                                    @foreach ($stores_star_average as $store_star_average)
                                    @if ($store_star_average->store_id == $store->id)
                                        <span class="toppage_rate" style="--score: {{ $store_star_average->star_average }}"></span>
                                        <span class="mx-3">{{ round($store_star_average->star_average, 1) }}</span>
                                    @endif
                                    @endforeach
                                    @if (!DB::table('reviews')->where('store_id', $store->id)->exists())
                                        <span class="toppage_rate" style="--score: {{ 0 }}"></span>
                                        <span class="mx-3">0.0</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="row my-5">
            <h3>新規掲載店</h3>
            <div class="row">
                @foreach ($new_stores as $store)
                <div class="col">
                    <a href="{{ route('stores.show', $store->id) }}" class="text-decoration-none toppage_card">
                        <div class="card h-100">
                            <div class="overflow-hidden card_img_top_size">
                                <img src="{{ asset('img/'. $store->store_img) }}" alt="店舗の画像" class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $store->store_name }}</h3>
                                @foreach ($store->categories()->orderBy('id', 'asc')->get() as $category)
                                    <span>{{ $category->name }}</span>
                                @endforeach
                                <p>{{ Str::limit($store->store_description, 15, '...') }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
