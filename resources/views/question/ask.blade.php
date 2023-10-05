<x-layout>
    <div class="d-flex mb-2 align-items-center justify-content-between" style="max-height: 38px !important;">
        <strong class="my-auto" style="font-size: 1.5rem">New Question</strong>
        <button class="btn btn-light btn-sm">Preview</button>
    </div>
    <form action="{{ route('store_question') }}" method="post" class="mb-2">
        @csrf
        <div class="mb-2">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Write something meaningful">
        </div>
        <div class="mb-2">
            <label for="body">Body</label>
            <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Explain in details"></textarea>
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
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Last Updated</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Lorem ipsum dolor sit amet.</td>
            <td>18th February 2000</td>
            <td>
                <button class="btn btn-primary btn-sm">Update</button>
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Lorem ipsum dolor sit amet.</td>
            <td>18th February 2000</td>
            <td>
                <button class="btn btn-primary btn-sm">Update</button>
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        </tbody>
    </table>
</x-layout>
