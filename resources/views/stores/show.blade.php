@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-6 mx-auto">
            <div>
                <a href="{{ route('stores.index') }}" class="text-decoration-none"><small>店舗一覧</small></a>
                <span>></span>
                <small>店舗詳細</small>
            </div>
            <h2 class="mt-5 mb-5 text-center fw-bold">{{ $store->store_name }}</h2>
            <div class="container d-flex align-items-center justify-content-center mb-5">
                <span class="fs-5">総合評価</span>
                @foreach ($stores_star_average as $store_star_average)
                    @if ($store_star_average->store_id == $store->id)
                        <span class="rate mx-3" style="--score: {{ $store_star_average->star_average }}"></span>
                        <span class="fs-5">{{ round($store_star_average->star_average, 1) }}</span>
                    @endif
                @endforeach
                @if (!DB::table('reviews')->where('store_id', $store->id)->exists())
                    <span class="rate mx-3" style="--score: {{ 0 }}"></span>
                    <span class="fs-5">0.0</span>
                @endif
                @foreach ($stores_review_count as $store_review_count)
                    @if ($store_review_count->store_id == $store->id)
                        <span class="fs-5 ms-3">({{ $store_review_count->count_review }})件</span>
                    @endif
                @endforeach
                @if (!DB::table('reviews')->where('store_id', $store->id)->exists())
                    <span class="fs-5 ms-3">(0)件</span>
                @endif
            </div>
            <div>
                <div>
                    <ul class="nav nav-tabs">
                        <li id="nav_infomation" class="nav-item active"><a href="#infomation" class="nav-link text-decoration-none">店舗情報</a></li>
                        <li id="nav_review" class="nav-item"><a href="#review" class="nav-link text-decoration-none">レビュー</a></li>
                    </ul>
                </div>
                {{-- 店舗情報 --}}
                <div id="area_infomation" class="area active">
                    <img src="{{ asset('img/'.$store->store_img) }}" alt="お店の画像" class="card-img-top">
                    <div class="container mt-3">
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-2">
                                <span>店舗名</span>
                            </div>
                            <div class="col">
                                <span>{{ $store->store_name }}</span>
                            </div>
                        </div>
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-2">
                                <span>説明</span>
                            </div>
                            <div class="col">
                                <span>{{ $store->store_description }}</span>
                            </div>
                        </div>
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-2">
                                <span>価格帯</span>
                            </div>
                            <div class="col">
                                <span>{{ $store->price }}</span>
                            </div>
                        </div>
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-2">
                                <span>郵便番号</span>
                            </div>
                            <div class="col">
                                <span>{{ $store->postal_code }}</span>
                            </div>
                        </div>
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-2">
                                <span>住所</span>
                            </div>
                            <div class="col">
                                <span>{{ $store->address }}</span>
                            </div>
                        </div>
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-2">
                                <span>営業時間</span>
                            </div>
                            <div class="col">
                                <span>{{ $store->open_time }}</span>
                            </div>
                        </div>
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-2">
                                <span>定休日</span>
                            </div>
                            <div class="col">
                                <span>{{ $store->regular_holiday }}</span>
                            </div>
                        </div>
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-2">
                                <span>座席数</span>
                            </div>
                            <div class="col">
                                <span>{{ $store->seating_number }}</span>
                            </div>
                        </div>
                        <div class="row pb-2 mb-2 border-bottom">
                            <div class="col-2">
                                <span>カテゴリー</span>
                            </div>
                            <div class="col">
                                @foreach ($store->categories()->orderBy('id', 'asc')->get() as $category)
                                    <span>{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- レビューの表示 --}}
                <div id="area_review" class="area">
                    {{-- レビュー --}}
                    <div class="my-3">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#createReviewModal">
                            <span>レビューを作成する</span>
                        </a>
                    </div>

                    {{-- レビュー作成用のモーダル --}}
                    @include('modals.create_review')

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- レビューの一覧表示 --}}
                    @foreach ($reviews as $review)
                        <div class="card mb-3">
                            <div class="row card-body">
                                <span class="d-block mb-2 pb-2 border-bottom border-secondary">{{ $review->user->name }}</span>
                                <span class="d-block mb-2 border-bottom border-secondary rate" style="--score: {{ $review->star_count }}"></span>
                                <p>{!! nl2br(e($review->content)) !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="my-5 text-center">
                @if ($store->isFavoritedBy(Auth::user()))
                    <a href="{{ route('stores.favorite', $store) }}" class="btn btn-primary" role="button">
                        <i class="fa fa-heart"></i>
                        お気に入り解除
                    </a>
                @else
                    <a href="{{ route('stores.favorite', $store) }}" class="btn btn-primary" role="button">
                        <i class="fa fa-heart"></i>
                        お気に入り登録
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
