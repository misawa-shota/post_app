@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            {{-- 検索エリアカラム --}}
            <div class="col-3">
                <div>
                    <form action="{{ route('stores.index') }}" action="get">
                        <div class="input-group">
                            <input type="text" name="keyword" value="{{ $keyword }}" placeholder="店舗名" class="form-control w-75">
                            <button type="submit" class="btn btn-primary">検索</button>
                        </div>
                    </form>
                </div>
                <div class="card my-5">
                    <div class="card-header">
                        カテゴリから探す
                    </div>
                    <div class="card-body">
                        <form action="{{ route('stores.index') }}" method="get">
                            <select name="category" id="" class="w-100 mb-3">
                                <option value="">選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary w-100">検索</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        価格帯から探す
                    </div>
                    <div class="card-body">
                        <form action="{{ route('stores.index') }}" method="get">
                            <select name="price" id="" class="w-100 mb-3">
                                <option value="">選択してください</option>
                                @foreach ($prices as $price)
                                    <option value="{{ $price->price }}">{{ $price->price }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary w-100">検索</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- 店舗一覧表示カラム --}}
            <div class="col-9">
                @if (session('flash_message'))
                    <p class="text-primary">{{ session('flash_message') }}</p>
                @endif
                <div class="d-flex justify-content-between align-items-center">
                    <p class="fs-4">{{ $count }}件の店舗が見つかりました。</p>
                    <form action="{{ route('stores.index') }}" method="get">
                        <select name="sort" onchange="this.form.submit()" class="form-select">
                            <option value=""
                                @if ($sort == '') selected @endif
                            >並べ替え</option>
                            <option value="create_timestamp"
                                @if ($sort == 'create_timestamp') selected @endif
                            >掲載日が新しい順</option>
                            <option value="price_asc"
                                @if ($sort == 'price_asc') selected @endif
                            >価格が安い順</option>
                            <option value="star_desc"
                                @if ($sort == 'star_desc') selected @endif
                            >評価が高い順</option>
                        </select>
                    </form>
                </div>
                @foreach ($stores as $store)
                    <a href="{{ route('stores.show', $store->id) }}" class="store_card text-decoration-none mb-3">
                        <span class="card store_card_label">
                            <span class="row g-0">
                                <span class="col-md-6">
                                    <img src="{{ asset('img/'.$store->store_img) }}" alt="お店の画像" class="card-img-top store_card_label">
                                </span>
                                <span class="col-md-6">
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
        </div>
        <div class="d-flex justify-content-center">
            {{ $stores->links() }}
        </div>
    </div>
@endsection
