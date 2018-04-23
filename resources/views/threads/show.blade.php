@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">
                        <a href="">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}
                    </div>
                    
                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>
        
                @foreach($replies as $reply)
                    @include ('threads.reply')
                @endforeach

                <br>

                {{ $replies->links() }}
        
                <br>
                @if (auth()->check())
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="body">Body:</label>
                            <textarea name="body" id="body" class="form-control" placeholder="Have say what?" rows="5"></textarea>
                            <br>
                            <button type="submit" class="btn btn-default">Post</button>
                        </div>
                    </form>
                @else

                 <p class="text-center"><a href="{{ route('login') }}">Sign in to comment.</a></p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-body">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection