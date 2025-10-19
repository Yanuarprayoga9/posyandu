@php
  // data awal untuk edit
  $o = $orangtua ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
  <div>
    <label class="block text-sm text-gray-700">No KK</label>
    <input name="no_kk" value="{{ old('no_kk', $o->no_kk ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('no_kk')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-700">NIK Ibu</label>
    <input name="nik_ibu" value="{{ old('nik_ibu', $o->nik_ibu ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('nik_ibu')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-700">Nama Ibu</label>
    <input name="nama_ibu" value="{{ old('nama_ibu', $o->nama_ibu ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('nama_ibu')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-700">Tanggal Lahir Ibu</label>
    <input type="date" name="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu', isset($o->tanggal_lahir_ibu) ? \Illuminate\Support\Carbon::parse($o->tanggal_lahir_ibu)->format('Y-m-d') : '') }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('tanggal_lahir_ibu')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-700">Golongan Darah Ibu</label>
    <select name="golongan_darah_ibu" class="mt-1 w-full rounded border-gray-300">
      @php
        $opsi = ['','A','B','AB','O','A+','A-','B+','B-','AB+','AB-','O+','O-'];
        $val = old('golongan_darah_ibu', $o->golongan_darah_ibu ?? '');
      @endphp
      @foreach($opsi as $opt)
        <option value="{{ $opt }}" @selected($val === $opt)>{{ $opt===''?'- pilih -':$opt }}</option>
      @endforeach
    </select>
    @error('golongan_darah_ibu')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-700">NIK Ayah</label>
    <input name="nik_ayah" value="{{ old('nik_ayah', $o->nik_ayah ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('nik_ayah')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-700">Nama Ayah</label>
    <input name="nama_ayah" value="{{ old('nama_ayah', $o->nama_ayah ?? '') }}" class="mt-1 w-full rounded border-gray-300" required>
    @error('nama_ayah')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div>
    <label class="block text-sm text-gray-700">No Telepon</label>
    <input name="no_telepon" value="{{ old('no_telepon', $o->no_telepon ?? '') }}" class="mt-1 w-full rounded border-gray-300">
    @error('no_telepon')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>

  <div class="md:col-span-2">
    <label class="block text-sm text-gray-700">Alamat</label>
    <textarea name="alamat" rows="3" class="mt-1 w-full rounded border-gray-300" required>{{ old('alamat', $o->alamat ?? '') }}</textarea>
    @error('alamat')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
  </div>
</div>
