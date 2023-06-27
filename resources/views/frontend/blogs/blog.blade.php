@extends('frontend.layouts.app')
@section('content')
	<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						@foreach($data as $key => $value)
						<div class="single-blog-post">
							<h3>{{$value->title}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i>{{$value->created_at->format('h:i')}}</li>
									<li><i class="fa fa-calendar"></i>{{$value->created_at->toFormattedDateString()}}</li>
								</ul>
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="">
								<img src="upload/blog/images/{{$value->image}}" alt="">
							</a>
							<p>{{$value->content}}</p>
							<a  class="btn btn-primary" href="{{url('/blog-single.html/'.$value->id)}}">Read More</a>
						</div>
						@endforeach
					</div>
					{{ $data->links('pagination::bootstrap-4') }}
@endsection