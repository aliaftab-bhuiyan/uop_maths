<x-layout>
    <p class="text-success lead text-uppercase fw-bold d-block text-center">{{ $name }}</p>
    @foreach($questions as $question)
        <x-question :question="$question" />
    @endforeach
    <div class="mt-3">
        {{ $questions->links('pagination::bootstrap-5') }}
    </div>
</x-layout>
