@extends('admin.layout.page')
@section('content')
<div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Country</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Country</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
    <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	@foreach($data as $key => $value)
                                            <tr>
                                                <th scope="row">{{$value->id}}</th>
                                                <td>{{$value->name}}</td>
                                                <td><a href="{{url('admin/country/edit/'.$value->id)}}">Edit</a></td>
												<td><a href="{{url('admin/country/delete/'.$value->id)}}">Delete</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
	<div class="form-group">
                                        <div class="col-sm-12">
                                            <a href="{{url('admin/country/add')}}" class="btn btn-success">Add</a>
                                        </div>
                                    </div>
@endsection