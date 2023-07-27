@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('flash_message'))
            <p class="text-primary">{{ session('flash_message') }}</p>
        @endif
        @foreach ($stores as $store)
            <a href="{{ route('stores.show', $store->id) }}" class="store_card text-decoration-none mb-3">
                <span class="card store_card_label">
                    <span class="row g-0">
                        <span class="col-md-4">
                            <img src="{{ asset('img/'.$store->store_img) }}" alt="お店の画像" class="card-img-top store_card_label">
                        </span>
                        <span class="col-md-8">
                            <span class="card-body store_card_label">
                                <dl>
                                    <dt class="fs-4 mb-1">{{ $store->store_name }}</dt>
                                    <dd class="border-bottom border-secondary pb-1 mb-4">
                                        @foreach ($store->categories()->orderBy('id', 'asc')->get() as $category)
                                            <span class="me-2">{{ $category->name }}</span>
                                        @endforeach
                                    </dd>
                                    <dd>
                                        <ul class="d-flex align-items-center review_list_group">
                                            @foreach ($stores_star_average as $store_star_average)
                                                @if ($store_star_average->store_id == $store->id)
                                                    <li><span class="rate" style="--score: {{ $store_star_average->star_average }}"></span></li>
                                                    <li><span class="mx-3">{{ round($store_star_average->star_average, 1) }}</span></li>
                                                @endif
                                            @endforeach
                                            @if (!DB::table('reviews')->where('store_id', $store->id)->exists())
                                                <li><span class="rate" style="--score: {{ 0 }}"></span></li>
                                                <li><span class="mx-3">0.0</span></li>
                                            @endif
                                            @foreach ($stores_review_count as $store_review_count)
                                                @if ($store_review_count->store_id == $store->id)
                                                    <li><span>({{ $store_review_count->count_review }})件</span></li>
                                                @endif
                                            @endforeach
                                            @if (!DB::table('reviews')->where('store_id', $store->id)->exists())
                                                <li><span>(0)件</span></li>
                                            @endif
                                        </ul>
                                    </dd>
                                    <dd>{{ $store->price }}</dd>
                                    <dd>{!! nl2br(e($store->store_description)) !!}</dd>
                                </dl>
                            </span>
                        </span>
                    </span>
                </span>
            </a>
        @endforeach
    </div>
@endsection
