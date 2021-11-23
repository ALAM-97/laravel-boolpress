@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>    
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="text-align: center" scope="col">#</th>
                                <th style="text-align: center" scope="col">Title</th>
                                <th style="text-align: center" scope="col">Slug</th>
                                <th style="text-align: center" scope="col">Category</th>
                                <th style="text-align: center" scope="col">Tags</th>
                                <th style="text-align: center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                            <tr>
                                <th>{{$post['id']}}</th>
                                <td style="text-align: center">{{$post['title']}}</td>
                                <td style="text-align: center">{{$post['slug']}}</td>
                                <td style="text-align: center">{{$post['category']['name'] ?? ''}}</td>
                                <td style="text-align: center">
                                    @if(count($post["tags"]) > 0)
                                        @foreach ($post["tags"] as $tag)
                                        <span class="badge badge-pill badge-dark">{{$tag["name"]}}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.posts.show', $post['id'])}}">
                                        <button type="button" class="btn btn-outline-primary">Check</button>
                                    </a>
                                    <a href="{{route('admin.posts.edit', $post['id'])}}">
                                        <button type="button" class="btn btn-outline-secondary">Edit</button>
                                    </a>
                                    <!-- Button trigger modal -->
                                    <button type="button" data-id="{{$post['id']}}" class="mt-1 btn btn-outline-danger btn-delete" data-toggle="modal" data-target="#deleteModal">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deleting Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.posts.destroy', 'id')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" id="delete-id" name="id">
                <div class="modal-body">
                    Are you sure you want to delete the post ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection