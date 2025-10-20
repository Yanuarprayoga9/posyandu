@extends('components.layouts.main-layout')
@section('title','Edit User')

@section('content')
<h2 class="text-lg font-semibold mb-4">Edit User</h2>
<form action="{{ route('users.update',$user) }}" method="POST" class="space-y-4 max-w-xl">
  @csrf @method('PUT')
  <div>
    <label class="block text-sm text-gray-700">Nama</label>
    <input name="name" value="{{ old('name',$user->name) }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>
  <div>
    <label class="block text-sm text-gray-700">Email</label>
    <input type="email" name="email" value="{{ old('email',$user->email) }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>
  <div>
    <label class="block text-sm text-gray-700">Password (opsional)</label>
    <input type="password" name="password" class="mt-1 w-full rounded border-gray-300">
    <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password.</p>
    @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>
  <div>
    <label class="block text-sm text-gray-700">Role</label>
    <select name="role" class="mt-1 w-full rounded border-gray-300" required>
      @foreach($roles as $val => $label)
        <option value="{{ $val }}" @selected($user->roles->pluck('name')->first() === $val)>{{ $label }}</option>
      @endforeach
    </select>
    @error('role')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>
  <div class="pt-2">
    <button class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Update</button>
    <a href="{{ route('users.index') }}" class="ml-2 px-4 py-2 bg-gray-100 rounded hover:bg-gray-200">Batal</a>
  </div>
</form>
@endsection
