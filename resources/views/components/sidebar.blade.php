<div class="flex-shrink-0 p-3 bg-white" style="width: 240px;">
    <ul class="list-unstyled ps-0">
    @if(Auth::guest())
        <li class="mb-1">
            <button class="btn btn-toggle bg-light text-dark-emphasis rounded-0 w-100 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
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
        <li class="mb-1">
            <span class="">DASHBOARD</span>
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
        <li class="mb-1">
            <span class="">
                TOP KEYWORDS
            </span>
            <div class="collapse show" id="orders-collapse">
                <ul class="btn-toggle-nav list-group list-unstyled fw-normal pb-1 small">
                    <li><a href="#" class="list-group-item list-group-item-action border-0">New</a></li>
                    <li><a href="#" class="list-group-item list-group-item-action border-0">Processed</a></li>
                    <li><a href="#" class="list-group-item list-group-item-action border-0">Shipped</a></li>
                    <li><a href="#" class="link-primary d-block float-end">See More >></a></li>
                </ul>
            </div>
        </li>
  @endif
    </ul>
</div>
