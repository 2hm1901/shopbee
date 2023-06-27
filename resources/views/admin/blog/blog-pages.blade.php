@extends('admin.layout.page')
@section('content')
	<div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Blog</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($data as $key => $value)
                                        <tr>
                                            <th scope="row">{{$value->id}}</th>
                                            <td>{{$value->title}}</td>
                                            <td>{{$value->image}}</td>
                                            <td>{{$value->description}}</td>
                                            <td>
                                            	<a href="{{url('admin/blog.html/edit/'.$value->id)}}">Edit</a>
                                            	<a href="{{url('admin/blog.html/delete/'.$value->id)}}">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="form-group">
                                        <div class="col-sm-12">
                                            <a href="blog.html/add" class="btn btn-success">Add</a>
                                        </div>
                                    </div>
                                 {{ $data->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>

@endsection