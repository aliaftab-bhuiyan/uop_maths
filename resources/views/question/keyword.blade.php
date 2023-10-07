<x-layout>
{{--    <p class="h3 text-dark mb-3">Keyword: <span class="text-dark-emphasis">{{ $kword }}</span></p>--}}
    @foreach($questions as $question)
        <x-question :question="$question" />
    @endforeach
</x-layout>
