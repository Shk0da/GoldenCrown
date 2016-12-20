<div class="navmenu navmenu-default navmenu-fixed-left">
    <a class="navmenu-brand" href="/">{{ config('app.name') }}</a>
    <ul class="nav navmenu-nav">
        <li><a href="/">Онлайн запись</a></li>

        @if (Auth::check())
            <li><hr></li>
            <li><a href="{{ route('panel') }}">Панель управления</a></li>
            <li><a href="{{ route('employee') }}">Сотрудники</a></li>
            <li><a href="{{ route('service.types') }}">Типы услуг</a></li>
            <li><a href="{{ route('services') }}">Услуги</a></li>
            <li><a href="{{ route('orders') }}">Заказы</a></li>
        @endif
    </ul>
    <ul class="nav navmenu-nav">
        <li><hr></li>
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Войти</a></li>
        @else
            <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Выйти</a></li>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                  style="display: none;">
                {{ csrf_field() }}
            </form>
        @endif
    </ul>
</div>
