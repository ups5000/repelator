@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @auth
        <div class="col-12 text-center">
            <div class="alert alert-info ">
                <p>Your share url is: {{ url('share').'/'.$code_share }}</p>
            </div>
        </div>
        @endauth
        <div class="col-md-8">

            @foreach( $products as $product)
                <div class="row mb-2 product_private_wishlist justify-content-center" data-id_product="{{$product->id}}">
                    @auth
                        <div data-id_product="{{$product->id}}" class="col-12 col-sm-12 text-danger font-weight-bold h5 isfav btn_wishlist">X</div>
                    @endauth
                    <div class="col-12 col-sm-3 text-center">
                        <img class="img-fluid" src="{{ asset('storage/'.$product->img_url) }}" alt="{{$product->title}}">
                    </div>
                    <div class="col-12 col-sm-6 text-center">
                        <div class="row">
                            <div class="col-12 col-sm-9"> {{ $product->title }} </div>
                            <div class="col-12 col-sm-3"> {{ $product->price }} </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
