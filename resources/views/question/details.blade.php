<x-layout>
    <p class="lead"><i class="fa fa-tags"></i> Tags: <a href=""><span class="badge badge-info">Bootstrap</span></a></p>
    <h1>{{ $question->title }}</h1>
    <p class="lead"><i class="fa fa-user"></i> by <a href="">{{ Str::lower($question->user->username) }}</a></p>
    <p class="lead"><i class="fa fa-calendar"></i> Posted on {{ $question->created_at->format('F d, Y') }} at {{ $question->created_at->format('h:i A') }}</p>
    <p class="lead">{!!  nl2br(e($question->body)) !!}</p>

    @if(Auth::user() == $question->user)
        <div class="d-flex gap-3">
            <a href="" class="link-primary">Edit</a>
            <a href="" class="link-danger">Delete</a>
            <a href="" class="link-secondary">Archive</a>
        </div>
    @endif
    <hr>
    <form method="POST">
        <div class="d-flex gap-3 align-items-center">
            <div class="hidden-xs">
                <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar7.png" height="52"  alt="">
            </div>
            <div class="flex-grow-1">
                <textarea class="form-control" id="message" placeholder="Write your solution" required=""></textarea>
            </div>
            <button type="submit" class="btn btn-dark rounded-circle" style="height: 52px; width: 52px"><i class="bi bi-send-fill"></i></button>
        </div>
    </form>
</x-layout>
