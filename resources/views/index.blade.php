@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb">
                <span class="mr-2">Sort by:</span>
                <a class="mr-1" href="{{url('?sort=price')}}">Price</a>
                <a class="mr-1" href="{{url('?sort=title')}}">Title</a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 text-center product-row pl-2">
                <div class="row">
                        <div class="col">
                            @auth
                                @if ( !in_array($product->id,$inWishlist) )
                                    <div data-id_product="{{$product->id}}" class="col-4 offset-6  col-sm-5 offset-sm-7 col-md-6 offset-md-6    btn_wishlist nofav"> +Add Fav!</div>
                                @else
                                    <div data-id_product="{{$product->id}}" class="col-4 offset-6  col-sm-5 offset-sm-7 col-md-6 offset-md-6  btn_wishlist isfav"> Is Fav!</div>
                                @endif
                            @endauth
                        <div class="col-12 "><img class=" img-thumbnail" src="{{ asset('storage/'.$product->img_url) }}" alt="{{$product->title}}"></div>
                        <div class="col-12 title p-2 text-capitalize">{{ Str::limit($product->title,40,'...') }}</div>
                        <div class="col-12 price">{{ $product->price }}€</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row pagination justify-content-center mt-5">
        @if ( !isset($sort)  )
            {{ $products->links() }}
        @elseif (isset($sort) && $sort == 'title')
        {{ $products->appends(['sort' => 'title'])->links() }}
        @elseif (isset($sort) && $sort == 'price')
        {{ $products->appends(['sort' => 'price'])->links() }}
        @endif

    </div>
</div>
@endsection
