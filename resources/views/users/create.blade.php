@extends('components.layouts.main-layout')
@section('title','Tambah User')

@section('content')
<h2 class="text-lg font-semibold mb-4">Tambah User</h2>
<form action="{{ route('users.store') }}" method="POST" class="space-y-4 max-w-xl">
  @csrf
  <div>
    <label class="block text-sm text-gray-700">Nama</label>
    <input name="name" value="{{ old('name') }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>
  <div>
    <label class="block text-sm text-gray-700">Email</label>
    <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>
  <div>
    <label class="block text-sm text-gray-700">Password</label>
    <input type="password" name="password" class="mt-1 w-full rounded border-gray-300" required>
    @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>
  <div>
    <label class="block text-sm text-gray-700">Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="mt-1 w-full rounded border-gray-300" required>
  </div>
  <div>
    <label class="block text-sm text-gray-700">Role</label>
    <select name="role" class="mt-1 w-full rounded border-gray-300" required>
      @foreach($roles as $val => $label)
        <option value="{{ $val }}" @selected(old('role')===$val)>{{ $label }}</option>
      @endforeach
    </select>
    @error('role')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>
  <div class="pt-2">
    <button class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Simpan</button>
    <a href="{{ route('users.index') }}" class="ml-2 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Batal</a>
  </div>
</form>
@endsection
