<div class="sidebar">
    <a href="@if (isset(Auth::user()->id)) {{ Auth::user()->type == 1 ? Route('lead') : Route('dashboard') }}">
        <img src="{{ asset('public/assets/images/logo.png') }}" alt="RGS Sale Dashboard">
    </a> @endif
    <div class="menu-Bar">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="menuWrap">
        <ul class="sidebarmenu">
            @if (isset(Auth::user()->id))
            <li>
                <a href="{{ Auth::user()->type == 1 ? Route('lead') : Route('dashboard') }}">
                    <i class="fad fa-th-large"></i>
                </a>
            </li>
            @endif
            <li>
                <a href="{{ Route('add_lead') }}">
                    <i class="fas fa-plus-square"></i>
                </a>
            </li>
            <li><a href="{{ Route('get_customers') }}"><i  class="fa fa-table" aria-hidden="true"></i></a></li>
            <li>
                <a href="index.php">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button style="background-color: transparent; border: none; outline: none; padding: 0%; margin: 0%"><i class="fad fa-sign-out-alt"></i></button>
                    </form>
                </a>
            </li>
        </ul>
    </div>
</div>