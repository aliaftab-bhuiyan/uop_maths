<div class="card mb-2">
    <div class="card-body d-flex">
        <div class="" style="width: 52px !important;">
            <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle" alt="">
        </div>
        <div class="flex-grow-1">
            <a href="{{ route('detail_question', ['slug' => $question->slug]) }}" class="card-title mb-0 h4 d-inline-block text-truncate" style="max-width: 980px;">{{ $question->title }}</a>
            <small class="text-muted d-block">{{ $question->updated_at->diffForHumans() }}</small>
            <p class="card-subtitle mt-2 text-muted">#hello #world</p>
            <div class="d-flex align-items-center justify-content-between">
                <div class="">
                    <a href="" class="card-link">39 Kudos</a>
                    <a href="" class="card-link">0 Solutions</a>
                </div>
                <button class="btn btn-light">Add to Collection</button>
            </div>
        </div>
    </div>
</div>
