@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Update post {{$post['id']}}</div>

                <div class="card-body">
                    <form action="{{route('admin.posts.update', $post['id'])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter Title" value="{{old('title') ?? $post['title']}}">
                            @error('title')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30" rows="10" placeholder="Enter Content">{{old('content') ?? $post['content']}}</textarea>
                            @error('content')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-control  @error('category_id') is-invalid @enderror">
                                <option value="">-- Select a category --</option>
                                @foreach ($categories as $category)
								@if ($errors->any())
									<option {{ old("category_id") == $category["id"] ? 'selected' : null }} value="{{$category["id"]}}">{{$category["name"]}}</option>
								@else
									<option {{isset($post["category"]) && $post["category"]["id"] == $category["id"] ? 'selected' : null }} value="{{$category["id"]}}">{{$category["name"]}}</option>
								@endif
								
								@endforeach
                            </select>
                            @error('category_id')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-outline-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection