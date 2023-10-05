<x-layout>
    @foreach($questions as $question)
        <x-question :question="$question" />
    @endforeach
</x-layout>
