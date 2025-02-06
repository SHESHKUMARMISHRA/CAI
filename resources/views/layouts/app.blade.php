<!-- resources/views/layouts/app.blade.php -->
@if(Session::has('api_token'))
    <p>{{ Session::get('user_first_name') }} {{ Session::get('user_last_name') }}</p>
    <a href="{{ route('logout') }}">Logout</a>
@endif
