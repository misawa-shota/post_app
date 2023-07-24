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
            <div>
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
        </div>
    </div>
@endsection
