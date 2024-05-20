@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div id="post">
                        <h5>Title : {{ $posting->title }}</h5>
                        <p>By : {{ optional($posting->user)->name }} <br> 
                            Category : {{ optional($posting->category)->name }}</p>
                        <p>{!! $posting->body !!}</p>
                    </div>
                    <hr>
                    <div id="comment">
                        <h5>Comments</h5>

                        <form action="{{route('comment.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $posting->id }}">
                            <textarea class="form-control"  name="comment" placeholder="Type your comment here" rows="3"></textarea>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        @if($comments->count() > 0)
                            <ul class="list-group mt-3">
                                @foreach($comments as $comment)
                                    <li class="list-group-item"><b>{{ optional($comment->user)->name }}</b> <br> {{ $comment->body }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p>No comments yet.</p>
                        @endif
                    </div>
                    
                    <button id="backButton" class="btn"><i class="fas fa-arrow-left"></i> Back</button>
                </div>
            </div>
        </div> 
    </div> 
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#backButton').click(function() {
            window.history.back();
        });
    });
</script>

