<x-layout>
    <ul class="nav nav-tabs my-3">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('show_question') }}">Public</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('draft_question') }}">Draft</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Archived</a>
        </li>
    </ul>
    @foreach($questions as $question)
        <x-question :question="$question" />
    @endforeach
    <div class="mt-3">
        {{ $questions->links('pagination::bootstrap-5') }}
    </div>
</x-layout>
