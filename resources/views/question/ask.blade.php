<x-layout>
    <div class="d-flex mb-2 align-items-center justify-content-between" style="max-height: 38px !important;">
        <strong class="my-auto" style="font-size: 1.5rem">New Question</strong>
        <button class="btn btn-light btn-sm">Preview</button>
    </div>
    <form action="{{ route('store_question') }}" method="post" class="mb-4">
        @csrf
        <div class="mb-2">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Write something meaningful">
            @error('title')
            <div class="form-text text-danger float-end">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="body">Body</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Explain in details"></textarea>
            @error('body')
            <div class="form-text text-danger float-end">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2">
            <label for="keywords">Keywords</label>
            <input type="text" name="keywords" id="keywords" class="form-control" placeholder="Press space to separate">
        </div>
        <div class="row gap-2 w-100 mx-auto">
            <input type="submit" name="draft" value="Draft" class="col-md btn btn-secondary btn-fluid w-100 mt-2">
            <input type="submit" name="submit" value="Publish" class="col-md btn btn-dark btn-fluid w-100 mt-2">
        </div>
    </form>
    <strong class="my-auto" style="font-size: 1.5rem">Draft Questions</strong>
    <table class=" mt-2 table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Created At</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @php($count=1)
        @foreach($draft_questions as $draft_question)
            <tr>
                <th class="align-middle" scope="row">{{ $count++ }}</th>
                <td class="align-middle">{{ $draft_question->title }}</td>
                <td class="align-middle">{{ $draft_question->created_at->format('d/m/Y') }}</td>
                <td class="d-flex gap-1 my-auto">
                    <a href="{{ route('update_question', ['slug'=>$draft_question->slug]) }}" class="btn btn-primary btn-sm">Update</a>
                    <a role="button" data-bs-toggle="modal" data-bs-target="#deleteQuestion" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="modal fade" id="deleteQuestion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Permission Required</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body lead">
                    Are you sure about deleting this draft question?<br> This can not be recovered later.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="{{ route('destroy_question', ['id' => $draft_question->id]) }}" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
