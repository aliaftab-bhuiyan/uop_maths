<div class="card px-3 py-2 mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <p class="mb-1 text-primary fw-bold lead">
            👉 {{ Str::lower($solution->user->username) }} <span class="text-muted small fw-normal"> was answered {{ $solution->updated_at->diffForHumans() }}</span>
        </p>
        <button class="btn btn-sm btn-light">Reply</button>
    </div>
    <p class="lead mx-4 mb-1">
        {{ $solution->body }}
    </p>
</div>
