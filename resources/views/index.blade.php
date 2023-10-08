<x-layout :top_keywords="$top_keywords">
    <form action="" method="post" class="d-flex mb-3 gap-2">
        @csrf
        <div class="input-group">
            <input type="search" name="" class="form-control w-75" placeholder="Search">
            <select class="form-select text-center" style="max-width: fit-content">
                <option value="question" selected>Question</option>
                <option value="keyword">Keyword</option>
            </select>
        </div>
        <input type="submit" value="Search" class="btn btn-dark">
    </form>
    @foreach($questions as $question)
        <x-question :question="$question" />
    @endforeach
    <div class="mt-3">
        {{ $questions->links('pagination::bootstrap-5') }}
    </div>
</x-layout>
