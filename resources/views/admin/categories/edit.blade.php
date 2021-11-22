@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit {{$category['name']}} Category</div>

                <div class="card-body">
                    <form action="{{route('admin.categories.update', $category['id'])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter category name" value="{{old('name') ?? $category['name']}}">
                            @error('name')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div> 
                        <button type="submit" class="btn btn-outline-secondary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection