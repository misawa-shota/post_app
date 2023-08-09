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
@endsection
