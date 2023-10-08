<div class="flex-shrink-0 p-3 pe-0" style="width: 240px;">
    <ul class="list-unstyled ps-0">
    @if(Auth::guest())
        <li class="mb-3 rounded bg-white">
            <button class="btn btn-toggle bg-light text-dark-emphasis rounded-0 w-100 fw-bold" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                WELCOME
            </button>
            <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav P-2 list-group list-unstyled fw-normal pb-1 small">
                    <li class="py-1 text-center"><small class="text-muted text-center">Login required for Access!</small></li>
                    <li><a class="btn btn-outline-light text-dark rounded-0 w-100" href="{{ route('login') }}">Login</a></li>
                </ul>
            </div>
        </li>
    @else
        <li class="mb-3 rounded bg-white">
            <span class="fw-bold d-block px-3 py-2">DASHBOARD</span>
            <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-group list-unstyled fw-normal pb-1 small">
                    <li>
                        <a href="{{ route('feed') }}" class="btn btn-outline-light text-dark-emphasis rounded-0 w-100">
                            Question Feed
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ask_question') }}" class="btn btn-outline-light text-dark-emphasis rounded-0 w-100">
                            Ask Question
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('show_question') }}" class="btn btn-outline-light text-dark-emphasis rounded-0 w-100">
                            Question Hub
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="mb-3 rounded bg-white">
            <span class="fw-bold d-block px-3 py-2">TOP KEYWORDS</span>
            <div class="collapse show" id="orders-collapse">
                <ul class="btn-toggle-nav list-group list-unstyled fw-normal pb-3 px-3">
                    @foreach($top_keywords as $keyword)
                        <li><a href="{{ route('find_by_keyword_feed', ['name'=> $keyword->name]) }}" class="py-0 link-success lead">
                                <small># {{ $keyword->name }}</small>
                            </a></li>
                    @endforeach
                </ul>
            </div>
        </li>
  @endif
    </ul>
</div>
