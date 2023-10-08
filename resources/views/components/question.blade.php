<div class="card mb-2 shadow-sm overflow-x-scroll">
    <div class="card-body d-flex">
        <div class="" style="width: 52px !important;">
            <img src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/fox.jpg" width="40" height="40" class="rounded-circle" alt="">
        </div>
        <div class="flex-grow-1">
            <a href="{{ route('detail_question', ['slug' => $question->slug]) }}" class="text-dark lead m-0 d-inline-block text-truncate" style="max-width: 720px;">{{ $question->title }}</a>
            <small class="d-block text-muted lead-sm">{{ $question->updated_at->diffForHumans() }}</small>
            <div class=" row d-flex align-items-center justify-content-between">
                <div class="m-0 col">
                    <span class="card-link">{{ $question->likes->count() }} Kudos</span>
                    <span class="card-link">{{ $question->solutions->count() }} Solutions</span>
                </div>
                <div class="col-8 overflow-y-scroll" style="max-height: 1.8rem">
                    @foreach($question->keyword as $k)
                    <a href="{{ route('find_by_keyword_feed', ['name'=> $k->name]) }}" class="mt-1 me-1 label link-success bg-light px-2 py-0 rounded float-end">{{$k->name}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
