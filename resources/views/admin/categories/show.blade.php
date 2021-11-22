@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
					<h1>{{$category["name"]}}</h1>
                    <h3>All posts associated:</h3>
                    <ul>
                        @forelse ($category['posts'] as $post)
                            <li>
                                {{$post['title']}}
                            </li>
                        @empty
                            <p>0 posts found</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection