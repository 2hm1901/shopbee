@extends('frontend.layouts.app')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 padding-right">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php 
						$getSession = session()->get('cart'); 

						$cart_total = 0;
						$total = 0;
						?>
						@foreach($getSession as $key => $value)
						<?php $total = $value['price'] * $value['quantity'] ?>
						<?php $cart_total += $total ?>
						<tr id="{{$value['product_id']}}">
							<td class="cart_product">
								<a href=""><img src="{{url('upload/product/hinh50_'.$value['image'])}}" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$value['name']}}</a></h4>
								<p>Web ID: {{$value['product_id']}}</p>
							</td>
							<td class="cart_price">
								<p>${{$value['price']}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<a class="cart_quantity_up"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$value['quantity']}}" autocomplete="off" size="2">
									<a class="cart_quantity_down"> - </a>
								</div>
							</td>
							<td class="cart_total">
								<p id="total" class="cart_total_price">${{$total}}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		</div>
	</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="row">
				<div class="col-sm-9 padding-right">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span id="cart_total">${{$cart_total}}</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span id="cart_total">${{$cart_total + 2}}</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a href="{{url('/check-out')}}" class="btn btn-default check_out">Check Out</a>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	</section><!--/#do_action-->
	<script>
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
    	});
		$(document).ready(function(){
    		$("a.cart_quantity_up").click(function(){
    			var idProduct = $(this).closest("tr").attr("id");

    			var cartTotal = $("span#cart_total").text().replace("$","");
    			var price= $(this).closest("tr").find("td.cart_price").find("p").text().replace("$","");
    			cartTotal = parseInt(cartTotal) + parseInt(price);
    			$("span#cart_total").text("$"+cartTotal);
    			var totalCart = cartTotal + 2;
    			$("span#total").text("$"+totalCart);

    			
    			var qty = $(this).closest("tr").find("td.cart_quantity").find("input").val();
    			qty = parseInt(qty) + 1;
    			$(this).closest("tr").find("td.cart_quantity").find("input").val(qty);

    			total = qty * parseInt(price);
    			$(this).closest("tr").find("td.cart_total").find("p").text("$"+total);  

    			var carTotal = $(this).closest("tr").find("td.cart_total").find("p").text();
    			carTotal = parseInt(carTotal) + parseInt(price)	

    			$.ajax({
					type: 'POST',
					url: "{{url('/cart/ajaxIncrease')}}",
					data:{
						id: idProduct
					},
					success:function(data){
				        console.log(data.success);
				        $("li#cart").find("a").text(data.success);
				   	}
				});
    		});

    		$("a.cart_quantity_down").click(function(){
    			var idProduct = $(this).closest("tr").attr("id");
    			
    			var cartTotal = $("span#cart_total").text().replace("$","");
    			var price= $(this).closest("tr").find("td.cart_price").find("p").text().replace("$","");
    			cartTotal = parseInt(cartTotal) - parseInt(price);
    			$("span#cart_total").text("$"+cartTotal);
    			var totalCart = cartTotal + 2;
    			$("span#total").text("$"+totalCart);

    			var qty = $(this).closest("tr").find("td.cart_quantity").find("input").val();
    			if (parseInt(qty) <= 1){
    				 $(this).closest("tr").remove();
    			}
    			else{
    			qty = parseInt(qty) - 1;
    			$(this).closest("tr").find("td.cart_quantity").find("input").val(qty);

    			total = qty * parseInt(price);
    			$(this).closest("tr").find("td.cart_total").find("p").text(total); 
    			}  			
    			$.ajax({
					type: 'POST',
					url: "{{url('/cart/ajaxDecrease')}}",
					data:{
						id: idProduct
					},
					success:function(data){
				        console.log(data.success);
				        $("li#cart").find("a").text(data.success);
				   	}
				});
    		});
    		
    		$("td.cart_delete").click(function(){
    			var idProduct = $(this).closest("tr").attr("id");

    			var cartTotal = $("span#cart_total").text().replace("$","");
    			var priceTotal= $(this).closest("tr").find("td.cart_total").find("p").text().replace("$","");
    			cartTotal = parseInt(cartTotal) - parseInt(priceTotal);
    			$("span#cart_total").text("$"+cartTotal);
    			var totalCart = cartTotal + 2;
    			$("span#total").text("$"+totalCart);

    			

    			$(this).closest("tr").remove();
    			$.ajax({
					type: 'POST',
					url: "{{url('/cart/ajaxDelete')}}",
					data:{
						id: idProduct
					},
					success:function(data){
				        console.log(data.success);
				        $("li#cart").find("a").text(data.success);
				   	}
				});
    		})
    	});
	</script>
@endsection