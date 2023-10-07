<x-layout>

    <p class="lead">
        Tags:
        @foreach ($question->keyword as $keyword)
            <a href="{{ route('find_by_keyword_feed', ['keyword'=> $keyword->id]) }}"><span class="bg-light rounded px-2 py-1 link-success">#{{ $keyword->name }}</span></a>
        @endforeach
    </p>
    <h1>{{ $question->title }}</h1>
    <p class="lead"><i class="fa fa-user"></i> by <a href="">{{ Str::lower($question->user->username) }}</a></p>
    <p class="lead"><i class="fa fa-calendar"></i> Posted on {{ $question->created_at->format('F d, Y') }} at {{ $question->created_at->format('h:i A') }}</p>
    <p class="lead">{!!  nl2br(e($question->body)) !!}</p>

    @if(Auth::user() == $question->user)
        <div class="d-flex gap-3">
            <a href="" class="link-primary">Edit</a>
            <a role="button" data-bs-toggle="modal" data-bs-target="#deleteQuestion" class="link-danger">Delete</a>
            <a href="" class="link-secondary">Archive</a>
        </div>
    @else
        <div class="d-flex gap-3">
            <a href="" class="link-primary">Kudos</a>
            <a href="" class="link-danger">Report</a>
        </div>
    @endif
    <hr>
    <form action="{{ route('store_solution', ['id'=>$question->id]) }}" method="POST">
        @csrf
        <p class="text-muted fw-semibold" style="font-size: 1.35rem">Write Solution:</p>
        <div class="d-flex gap-3 align-items-center">
            <div class="hidden-xs">
                <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar7.png" height="52"  alt="">
            </div>
            <div class="flex-grow-1">
                <textarea class="form-control" id="message" name="body" placeholder="Write your solution" required></textarea>
            </div>
            <button type="submit" class="btn btn-dark rounded-circle" style="height: 52px; width: 52px"><i class="bi bi-send-fill"></i></button>
        </div>
    </form>
    @foreach($question->solutions as $solution)
        <div class="card px-3 py-2 mt-4">
            <div class="d-flex justify-content-between align-items-center">
                <p class="mb-1 text-primary fw-bold lead">
                    👉 {{ Str::lower($solution->user->username) }} <span class="text-muted fw-normal"> has found a solution {{ $solution->updated_at->diffForHumans() }}</span>
                </p>
                <a href="#"><span class="lead">Reply</span></a>
            </div>
            <p class="lead mx-4 mb-1">
                {{ $solution->body }}
            </p>
        </div>
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
