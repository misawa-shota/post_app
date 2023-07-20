<a href="{{ route('stores.create') }}">お店の追加</a>
@if (session('flash_message'))
    <p>{{ session('flash_message') }}</p>
@endif
<table>
    <tr>
        <th>店舗名</th>
        <th>店舗説明</th>
        <th>価格帯</th>
        <th>郵便番号</th>
        <th>住所</th>
        <th>営業時間</th>
        <th>定休日</th>
        <th>座席数</th>
        <th>カテゴリー</th>
    </tr>
    @foreach ($stores as $store)
        <tr>
            <td>{{ $store->store_name }}</td>
            <td>{{ $store->store_description }}</td>
            <td>{{ $store->price }}</td>
            <td>{{ $store->postal_code }}</td>
            <td>{{ $store->address }}</td>
            <td>{{ $store->open_time }}</td>
            <td>{{ $store->regular_holiday }}</td>
            <td>{{ $store->seating_number }}</td>
            <td>
                @foreach ($store->categories()->orderBy('id', 'asc')->get() as $category)
                    <span>{{ $category->name }}</span>
                @endforeach
            </td>
            <td>
                <form action="{{ route('stores.destroy', $store->id) }}" method="post">
                    <a href="{{ route('stores.show', $store->id) }}">詳細を見る</a>
                    <a href="{{ route('stores.edit', $store->id) }}">編集する</a>
                    @csrf
                    @method('delete')
                    <button type="submit">削除する</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
