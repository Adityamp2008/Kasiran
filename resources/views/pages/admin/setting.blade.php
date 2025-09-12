@extends('layouts.app')
@section('title', 'Ganti Password')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-lg bg-white shadow-md rounded-xl p-5">
        <h2 class="text-2xl font-bold text-center text-blue-600 mb-4">Ganti Password</h2>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-700 px-3 py-2 rounded mb-3 text-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-700 px-3 py-2 rounded mb-3 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('setting.updatePassword') }}" method="POST" class="space-y-3">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
                <input type="password" name="current_password" required
                       class="w-full border border-gray-300 rounded px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                <input type="password" name="new_password" required
                       class="w-full border border-gray-300 rounded px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation" required
                       class="w-full border border-gray-300 rounded px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded text-sm font-medium hover:bg-blue-700 transition">
                Update Password
            </button>
        </form>
    </div>
</div>
@endsection
