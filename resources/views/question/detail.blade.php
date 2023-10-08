<x-layout>
@if(!$question->is_public)
    <div class="bg-white p-3 rounded d-flex align-items-center justify-content-between">
        <span class="text-danger lead fw-bold">Draft Question</span>
        <form action="{{ route('edit_question', ['slug'=>$question->slug]) }}" method="post">
            @csrf @method('PUT')
            <input type="submit" class="btn btn-primary btn-sm" value="Publish Now">
        </form>
    </div>
@endif
    <div class="bg-white p-3 rounded mt-3">
        <p class="lead">
            Keywords:
            @foreach ($question->keyword as $keyword)
                <a href="{{ route('find_by_keyword_feed', ['name'=> $keyword->name]) }}"><span class="bg-light rounded px-2 py-1 link-success">#{{ $keyword->name }}</span></a>
            @endforeach
        </p>
        <h1>{{ $question->title }}</h1>
        <p class="lead"><i class="fa fa-user"></i> by <a href="">{{ Str::lower($question->user->username) }}</a> - <i class="small">{{ $question->created_at->format('F d, Y') }} at {{ $question->created_at->format('h:i A') }}</i></p>
        <p class="lead">{!!  nl2br(e($question->body)) !!}</p>
        <p class="text-muted mb-0 d-flex gap-3">
            <span>
                <i class="bi-hand-thumbs-up"></i> {{ $question->likes()->count() }} kudos
            </span>
            <span>
                <i class="bi-inbox"></i> {{ $question->solutions->count() }} solutions
            </span>
        </p>
    </div>
    <div class="bg-white px-3 py-2 rounded mt-3 d-flex align-items-center justify-content-between">
        @if(Auth::user() == $question->user)
        <div class="d-flex gap-3">
            <a href="{{ route('update_question', ['slug'=>$question->slug]) }}" class="link-primary">Edit</a>
            <a role="button" data-bs-toggle="modal" data-bs-target="#deleteQuestion" class="link-danger">Delete</a>
            <a href="" class="link-secondary">Archive</a>
        </div>
        @else
        <div class="d-flex">
            @if (auth()->check() && !$question->likes()->where('user_id', auth()->id())->exists())
            <form action="{{ route('question_like', ['id'=>$question->id]) }}" method="post">
                @csrf
                <button type="submit" class="btn m-0 link-primary">
                    <i class="bi-hand-thumbs-up"></i> Kudos
                </button>
            </form>
            @else
            <form action="{{ route('question_unlike', ['id'=>$question->id]) }}" method="post">
                @csrf @method('DELETE')
                <button type="submit" class="btn m-0 link-primary">
                    <i class="bi-hand-thumbs-down"></i> Rebuke
                </button>
            </form>
            @endif
            <form action="" method="post">
                @csrf
                <button class="btn m-0 link-danger">Report</button>
            </form>
        </div>
        @endif
        <div class="d-flex gap-3" style="font-size: 1.5rem">
            <i class="bi-facebook text-primary"></i>
            <i class="bi-linkedin text-info"></i>
            <i class="bi-google text-danger"></i>
        </div>
    </div>
    <form class="mt-3" action="{{ route('store_solution', ['id'=>$question->id]) }}" method="POST">
        @csrf
        <div class="d-flex gap-3 align-items-center">
            <div class="hidden-xs">
                <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar7.png" height="52"  alt="">
            </div>
            <div class="flex-grow-1">
                <textarea class="form-control" id="message" name="body" placeholder="WRITE YOUR SOLUTION HERE" required></textarea>
            </div>
            <button type="submit" class="btn btn-dark rounded-circle" style="height: 52px; width: 52px"><i class="bi bi-send-fill"></i></button>
        </div>
    </form>
    @foreach($question->solutions as $solution)
        <x-solution :solution="$solution" />
    @endforeach
    <div class="modal fade" id="deleteQuestion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Permission Required</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body lead">
                    Are you sure about deleting this question?<br> This can not be recovered later.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('destroy_question', ['id' => $question->id]) }}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
