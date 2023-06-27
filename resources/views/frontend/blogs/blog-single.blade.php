@extends('frontend.layouts.app')
@section('content')
	<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						@foreach($data as $key => $value)
						<div class="single-blog-post">
							<h3>{{$value->title}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i>Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> {{$value->created_at->format('h:i')}}</li>
									<li><i class="fa fa-calendar"></i> {{$value->created_at->toFormattedDateString()}}</li>
								</ul>
								<!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
								
							</div>
							<a href="">
								<img src="../upload/blog/images/{{$value->image}}" alt="">
							</a>
							<p>{{$value->content}}</p>
							<div class="pager-area">
								<ul class="pager pull-right">
									@if($pre)
									<li><a href="{{url('/blog-single.html/'.$pre)}}">Pre</a></li>
									@endif
									@if($next)
									<li><a href="{{url('/blog-single.html/'.$next)}}">Next</a></li>
									@endif
								</ul>
							</div>
						</div>
					</div><!--/blog-post-area-->
					@endforeach

					<div class="rating-area">
						<div class="rate">
			                <div class="vote">
			                	<?php for ($i=1; $i<=5 ; $i++) { ?>
			                    <div class="star_1 ratings_stars {{ $i <= $averageMark ? 'ratings_over' : '' }}"><input value=" {{$i}}" type="hidden"></div>
			                	<?php } ?>
			                    <span class="rate-np">{{$averageMark}}</span>
			                </div> 
			            </div>
					
						
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="{{asset('frontend/images/blog/socials.png')}}" alt=""></a>
					</div><!--/socials-share-->

					
					<div class="response-area">
						<h2>3 RESPONSES</h2>
						
					@foreach($comment as $key => $value)
						<?php $level = $value->id ?>
						@if($value->level == 0)
						<ul class="media-list" id="{{$value->id}}">
							<li class="media">
								
								<a class="pull-left" href="#">
									<img class="media-object" src="{{asset('frontend/images/blog/man-two.jpg')}}" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>Janis Gallagher</li>
										<li><i class="fa fa-clock-o"></i> {{$value->created_at->format('h:i')}}</li>
										<li><i class="fa fa-calendar"></i>{{$value->created_at->toFormattedDateString()}}</li>
									</ul>
									<p>{{$value->comment}}</p>
									<a class="btn btn-primary" href="#cmt"><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li>
							@endif
							@foreach($comment as $key => $value)
							@if($value->level == $level)
							<li class="media second-media">
								<a class="pull-left" href="#">
									<img class="media-object" src="{{asset('frontend/images/blog/man-three.jpg')}}" alt="">
								</a>
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>Janis Gallagher</li>
										<li><i class="fa fa-clock-o"></i>{{$value->created_at->format('h:i')}}</li>
										<li><i class="fa fa-calendar"></i>{{$value->created_at->toFormattedDateString()}}</li>
									</ul>
									<p>{{$value->comment}}</p>
									<a href="#cmt" class="btn btn-primary"><i class="fa fa-reply"></i>Replay</a>
								</div>
							</li>
							@endif
							@endforeach
						</ul>	
					@endforeach		
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								<form method="post" action="{{url('/blog/comment')}}">
									@csrf
									<div class="text-area">
										<div class="blank-arrow">
											<label>Your Name</label>
										</div>
										<span>*</span>
										<textarea id="cmt" name="comment" rows="11"></textarea>
										<input type="hidden" name="id_cmt" class="id_cmt" value="0">
										<input type="hidden" name="id_blog" value="{{$id_blog}}">
										<button class="btn btn-primary" type="submit">Post comment</button>
									</div>
								</form>
							</div>
						</div>
					</div><!--/Repaly Box-->
				</div>
				<script>
    	$.ajaxSetup({
        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    	$(document).ready(function(){
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	            }
	        );

			$('.ratings_stars').click(function(){
				if (!{{Auth::check()}}) {
					alert('Please Login!');
				}
				else{
					var Values =  $(this).find("input").val();
					$("span.rate-np").text(Values);
			        // alert(Values);
			    	if ($(this).hasClass('ratings_over')) {
			            $('.ratings_stars').removeClass('ratings_over');
			            $(this).prevAll().andSelf().addClass('ratings_over');
			        } else {
			        	$(this).prevAll().andSelf().addClass('ratings_over');
			        }

			        $.ajax({
			        	type:'POST',
			        	url:"{{url('/blog/ajaxRate')}}",
			        	data:{
			        		mark:Values,
			        		id_blog:{{$id_blog}}
			        	},
			        	success:function(data){
			        		console.log(data.success);
			        	}
			        });
		    	}
		    });

			//comment
		    $('form').submit(function(){
		    	
		    	if (!{{Auth::check()}}) {
					alert('Please Login!');
				}
				else{
					var comment = $(this).closest('div.text-area').find('textarea').val();
					
					if(comment == ""){
						alert('Please enter your comment!');
					}else{
						return true;
					}
		    	}	

		    	return false;
		    });

		    //reply
		    $('a.btn-primary').click(function(){
		    	var id_cmt = $(this).closest('ul.media-list').attr('id');
		    	$('input.id_cmt').val(id_cmt);
		    });
		});
    </script>	
@endsection