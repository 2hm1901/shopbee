@extends('frontend.layouts.app')
@section('content')
	<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						@if($data)
						@foreach($data as $key => $value)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<?php  $getArrImage = json_decode($value['images'], true)?>
											<img class="{{$getArrImage[0]}}" src="{{url('upload/product/hinh200_'.$getArrImage[0])}}" alt="" />
											<h2>${{$value['price']}}</h2>
											<p id="{{$value['id']}}">{{$value['name']}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>${{$value['price']}}</h2>
												<p>{{$value['name']}}</p>
												<a class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="{{url('/product-details/'.$value['id'])}}"><i class="fa fa-plus-square"></i>Detail</a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
						@else
						<h1>No Item Can't Found!</h1>
						@endif
					</div><!--features_items-->
@endsection