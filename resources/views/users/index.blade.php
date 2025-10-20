@extends('components.layouts.main-layout')
@section('title','Manajemen User')

@section('content')
<div class="flex items-center justify-between mb-4">
  <h2 class="text-lg font-semibold">Manajemen User</h2>
  <a href="{{ route('users.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Tambah User</a>
</div>

@if(session('success'))
  <div class="mb-3 p-3 bg-green-50 border border-green-200 text-sm text-green-800 rounded">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="mb-3 p-3 bg-red-50 border border-red-200 text-sm text-red-800 rounded">{{ session('error') }}</div>
@endif

<div class="overflow-x-auto">
  <table class="min-w-full bg-white border rounded">
    <thead class="bg-gray-50">
      <tr>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Nama</th>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Email</th>
        <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">Role</th>
        <th class="px-4 py-2 text-right text-sm font-medium text-gray-600">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y">
      @foreach($users as $u)
      <tr>
        <td class="px-4 py-2">{{ $u->name }}</td>
        <td class="px-4 py-2">{{ $u->email }}</td>
        <td class="px-4 py-2">
          @foreach($u->getRoleNames() as $r)
            <span class="inline-flex px-2 py-1 text-xs bg-teal-50 text-teal-700 rounded border border-teal-200">{{ $r }}</span>
          @endforeach
        </td>
        <td class="px-4 py-2 text-right">
          <a href="{{ route('users.edit',$u) }}" class="px-3 py-1 text-sm bg-amber-500 text-white rounded hover:bg-amber-600">Edit</a>
          <form action="{{ route('users.destroy',$u) }}" method="POST" class="inline"
                onsubmit="return confirm('Hapus user ini?')">
            @csrf @method('DELETE')
            <button class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">Hapus</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $users->links() }}
</div>
@endsection
