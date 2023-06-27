@extends('admin.layout.page')
@section('content')
	<div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4 class="card-title">Create Blogs</h4>
                            
                            <form class="form-horizontal m-t-30" method="post" enctype="multipart/form-data">
                                @csrf
                                @foreach($data as $key => $value)
                                <div class="form-group">
                                    <label>Title(*)</label>
                                    <input type="text" class="form-control" name="title" value="{{$value->title}}">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image" value="{{$value->image}}">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="4" name="description">{{$value->description}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="form-control" rows="4" name="content" id="editor1">{{$value->content}}</textarea>
                                </div>
                                @endforeach
                                <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Edit</button>
                                        </div>
                                    </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
@endsection