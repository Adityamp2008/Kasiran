<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{env('app_name')}} | Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-white text-gray-900 antialiased">
    <main class="min-h-screen grid place-items-center p-4">
        <form action="{{ route('login') }}" method="POST"
              class="w-full max-w-md space-y-6 border border-blue-100 rounded-2xl p-8 shadow-xl bg-white"
              aria-labelledby="title">
            @csrf

            <h1 id="title" class="text-2xl font-semibold tracking-tight text-blue-600 text-center">Masuk</h1>

            @if ($errors->any())
                <div class="text-red-500 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="space-y-2">
                <label for="email" class="text-sm text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       placeholder="you@example.com"
                       class="w-full rounded-lg border border-blue-200 px-4 py-3 outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-200 text-base"/>
            </div>

            <div class="space-y-2">
                <label for="password" class="text-sm text-gray-700">Password</label>
                <input id="password" name="password" type="password" required minlength="6"
                       class="w-full rounded-lg border border-blue-200 px-4 py-3 outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-200 text-base"/>
            </div>

            <button type="submit"
                    class="w-full rounded-lg bg-blue-600 text-white px-4 py-3 text-base font-medium hover:bg-blue-700 transition">
                Login
            </button>
        </form>
    </main>
</body>
</html>
