@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 text-center product-row pl-2">
                <div class="row">
                        <div class="col">
                            @auth
                                <div data-id_product="{{$product->id}}" class="col-6 offset-6 btn_wishlist"> +Add Fav!</div>
                            @endauth
                        <img class="col-12 image_product img-thumbnail p-4" src="{{ asset('storage/'.$product->img_url) }}" alt="{{$product->title}}">
                        <div class="col-12 title p-2 text-capitalize">{{ Str::limit($product->title,40,'...') }}</div>
                        <div class="col-12 price">{{ $product->price }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row pagination justify-content-center mt-5">
        {{ $products->links() }}
    </div>
</div>
@endsection
