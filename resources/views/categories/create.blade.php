<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-800">{{ isset($category) ? 'Edit' : 'Tambah' }} Kategori</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Form Tambah/Edit Kategori -->
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                method="POST" class="bg-white p-8 mb-10 rounded-xl shadow-2xl border border-gray-100">
                @csrf
                @if (isset($category))
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $category->id }}">
                @endif

                <!-- Alert Success -->
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="space-y-6">
                    <!-- Input Nama Kategori -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                        <input type="text" name="nama" id="nama"
                            value="{{ old('nama', $category->nama ?? '') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input Keterangan -->
                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">{{ old('keterangan', $category->keterangan ?? '') }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Button Simpan -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300">
                            {{ isset($category) ? 'Update' : 'Simpan' }} Kategori
                        </button>
                    </div>
                </div>
            </form>

            <!-- Daftar Kategori -->
            <div class="mt-10">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Daftar Kategori</h2>
                <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Keterangan</th>
                                <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($categories as $cat)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $cat->nama }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $cat->keterangan }}</td>
                                    <td class="px-4 py-3 text-sm space-x-4">
                                        <a href="{{ route('categories.edit', $cat->id) }}"
                                            class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('categories.destroy', $cat->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-sm text-gray-500 text-center">Tidak ada
                                        kategori</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
