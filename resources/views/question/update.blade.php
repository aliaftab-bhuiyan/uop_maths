<x-layout>
    <div class="d-flex mb-2 align-items-center justify-content-between" style="max-height: 38px !important;">
        <strong class="my-auto" style="font-size: 1.5rem">Update Question</strong>
        <button class="btn btn-light btn-sm">Preview</button>
    </div>
    <form action="{{ route('edit_question', ['slug'=>$question->slug]) }}" method="post" class="mb-2">
        @csrf @method('PUT')
        <div class="mb-2">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Write something meaningful" value="{{ $question->title }}">
        </div>
        <div class="mb-2">
            <label for="body">Body</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Explain in details">{{ $question->body }}</textarea>
        </div>
        <div class="mb-2">
            <label for="keywords">Keywords</label>
            <input type="text" name="keywords" id="keywords"  class="form-control" placeholder="Press space to separate" value="{{ $question->keyword->pluck('name')->implode(' ') }}">
        </div>
        <div class="row gap-2 w-100 mx-auto">
        @if(!$question->is_public)
            <input type="submit" name="draft" value="Draft" class="col-md btn btn-secondary btn-fluid w-100 mt-2">
        @endif
            <input type="submit" name="submit" value="Publish" class="col-md btn btn-dark btn-fluid w-100 mt-2">
        </div>
    </form>
</x-layout>
