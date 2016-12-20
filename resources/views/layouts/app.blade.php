<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
