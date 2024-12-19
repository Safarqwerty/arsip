<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Arsip</h1>
            <a href="{{ route('finance-documents.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 transition-colors flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Arsip
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Pencarian dan Filter -->
            <form method="GET" action="{{ route('finance-documents.index') }}" class="mb-6 flex space-x-4">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full p-2 border border-gray-300 rounded-lg"
                        placeholder="Cari berdasarkan nama arsip atau kode arsip">
                </div>
                <div>
                    <select name="kategori" class="p-2 border border-gray-300 rounded-lg">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $kategori)
                            <option value="{{ $kategori->nama }}"
                                {{ request('kategori') == $kategori->nama ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                        Cari
                    </button>
                    <a href="{{ route('finance-documents.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Reset
                    </a>
                </div>
            </form>

            <!-- Tabel Arsip -->
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kode Arsip
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama Arsip
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Keterangan
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($documents as $document)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $loop->iteration + ($documents->currentPage() - 1) * $documents->perPage() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $document->kode_arsip }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $document->nama_arsip }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $document->kategori }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ Str::limit($document->keterangan, 50) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <a href="{{ route('finance-documents.show', $document) }}"
                                        class="text-green-600 hover:text-green-800">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada arsip yang tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($documents->hasPages())
                <div class="mt-6">
                    {{ $documents->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
