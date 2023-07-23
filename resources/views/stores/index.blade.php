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
