@extends('admin.layout.page')
@section('content')
	<div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <h4 class="card-title">Create Blogs</h4>
                            
                            <form class="form-horizontal m-t-30" method="post" enctype="multipart/form-data">
                            	@csrf
                                <div class="form-group">
                                    <label>Title(*)</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="4" name="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea class="form-control" rows="4" name="content" id="content"></textarea>
                                </div>
                                <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Upload</button>
                                        </div>
                                    </div>
                            </form>
                            
                        </div>
                    </div>
                </div>


@endsection

