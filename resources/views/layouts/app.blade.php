<!DOCTYPE html>
<html>
@include('layouts.head')
<body>

@include('layouts.header')

<div class="canvas">

    @include('layouts.nav')

    <div class="container">
        @yield('content')
    </div>
</div>

@include('layouts.footer')
</body>
</html>
