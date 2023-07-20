<div>
    <h2>店舗情報を編集する</h2>
</div>
<div>
    <a href="{{ route('stores.index') }}">Back</a>
</div>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('stores.update', $store->id) }}" method="post">
    @csrf
    @method('patch')
    <div>
        <strong>店舗名：</strong>
        <input type="text" name="store_name" placeholder="店舗名" value="{{ old('store_name', $store->store_name) }}">
    </div>
    <div>
        <strong>説明：</strong>
        <textarea name="store_description" id="" cols="30" rows="10" placeholder="店舗に関する説明">{{ old('store_description', $store->store_description) }}</textarea>
    </div>
    <div>
        <strong>価格帯：</strong>
        <input type="text" name="price" placeholder="価格帯" value="{{ old('price', $store->price) }}">
    </div>
    <div>
        <strong>郵便番号：</strong>
        <input type="text" name="postal_code" placeholder="郵便番号" value="{{ old('postal_code', $store->postal_code) }}">
    </div>
    <div>
        <strong>住所：</strong>
        <input type="text" name="address" placeholder="住所" value="{{ old('address', $store->address) }}">
    </div>
    <div>
        <strong>営業時間：</strong>
        <input type="text" name="open_time" placeholder="営業時間" value="{{ old('open_time', $store->open_time) }}">
    </div>
    <div>
        <strong>定休日：</strong>
        <input type="text" name="regular_holiday" placeholder="定休日" value="{{ old('regular_holiday', $store->regular_holiday) }}">
    </div>
    <div>
        <strong>座席数：</strong>
        <input type="text" name="seating_number" placeholder="座席数" value="{{ old('seating_number', $store->seating_number) }}">
    </div>
    <div>
        <strong>カテゴリー：</strong>
        @foreach ($categories as $category)
            <label for="">
                <div>
                    @if ($store->categories()->where('category_id', $category->id)->exists())
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}" checked>
                    @else
                        <input type="checkbox" name="category_ids[]" value="{{ $category->id }}">
                    @endif
                    <span>{{ $category->name }}</span>
                </div>
            </label>
        @endforeach
    </div>
    <button type="submit">
        店舗情報を修正する
    </button>
</form>
