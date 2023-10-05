<x-layout>
    <ul class="nav nav-tabs my-3">
        <li class="nav-item">
            <a class="nav-link active" href="#">Question</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Solution</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Collection</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">Archived</a>
        </li>
    </ul>
    @foreach($questions as $question)
        <x-question :question="$question" />
    @endforeach
</x-layout>
