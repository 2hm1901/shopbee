<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	
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
						$getSession = $data['body']; 

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
									
									<input class="cart_quantity_input" type="text" name="quantity" value="{{$value['quantity']}}" autocomplete="off" size="2">
									
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
	
</body>
</html>