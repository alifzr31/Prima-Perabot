<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
</head>

<body>
    @if (session()->has('error'))
        {{ session('error') }}
    @endif


    <form action="{{ route('login.store') }}" method="POST">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}">
        @error('email')
            {{ $message }}
        @enderror
        <input type="password" name="password">
        @error('password')
            {{ $message }}
        @enderror
        <button type="submit">Masuk</button>
    </form>
</body>

</html>
