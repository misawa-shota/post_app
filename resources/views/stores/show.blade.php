<div>
    <h2>店舗詳細</h2>
</div>
<div>
    <a href="{{ route('stores.index') }}">Back</a>
</div>
@if (session('flash_message'))
    <p>{{ session('flash_message') }}</p>
@endif
<div>
    <strong>店舗名：</strong>
    {{ $store->store_name }}
</div>
<div>
    <strong>説明：</strong>
    {!! nl2br(e($store->store_description)) !!}
</div>
<div>
    <strong>価格帯：</strong>
    {{ $store->price }}
</div>
<div>
    <strong>郵便番号：</strong>
    {{ $store->postal_code }}
</div>
<div>
    <strong>住所：</strong>
    {{ $store->address }}
</div>
<div>
    <strong>営業時間：</strong>
    {{ $store->open_time }}
</div>
<div>
    <strong>定休日：</strong>
    {{ $store->regular_holiday }}
</div>
<div>
    <strong>座席数：</strong>
    {{ $store->seating_number }}
</div>
<div>
    <strong>カテゴリー：</strong>
    @foreach ($store->categories()->orderBy('id', 'asc')->get() as $category)
        <span>{{ $category->name }}</span>
    @endforeach
</div>
