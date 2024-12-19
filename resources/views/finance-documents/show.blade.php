<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Detail Arsip</h1>
            <a href="{{ route('finance-documents.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg shadow-md hover:bg-gray-300 transition-colors flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 rounded-xl shadow-2xl border border-gray-100">
                <!-- Document Information Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-700 mb-4">Informasi Arsip</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Kode Arsip</p>
                            <p class="text-lg text-gray-800">{{ $document->kode_arsip }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Nama Arsip</p>
                            <p class="text-lg text-gray-800">{{ $document->nama_arsip }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Kategori</p>
                            <p class="text-lg text-gray-800">{{ $document->kategori }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-500">Tanggal Unggah</p>
                            <p class="text-lg text-gray-800">{{ $document->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Document Description Section -->
                <div class="mb-8">
                    <p class="text-sm font-medium text-gray-500 mb-2">Keterangan</p>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-800">{{ $document->keterangan ?: 'Tidak ada keterangan.' }}</p>
                    </div>
                </div>

                <!-- File Preview Section -->
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-sm font-medium text-gray-500">Pratinjau File</p>
                        <a href="{{ route('finance-documents.download', $document) }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            Unduh File
                        </a>
                    </div>

                    <div class="border rounded-lg overflow-hidden">
                        @php
                            $fileExtension = strtolower(pathinfo($document->file_path, PATHINFO_EXTENSION));
                        @endphp

                        @if ($fileExtension === 'pdf')
                            <iframe src="{{ Storage::url($document->file_path) }}" class="w-full h-[800px]"
                                frameborder="0">
                            </iframe>
                        @elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($document->file_path) }}"
                                alt="Preview {{ $document->nama_arsip }}" class="w-full h-auto">
                        @elseif ($fileExtension === 'csv')
                            @php
                                try {
                                    $csvPath = Storage::path($document->file_path);
                                    $hasData = false;
                                    $headers = [];
                                    $rows = [];

                                    if (file_exists($csvPath)) {
                                        $csvFile = fopen($csvPath, 'r');
                                        if ($csvFile !== false) {
                                            $headers = fgetcsv($csvFile);
                                            while (($row = fgetcsv($csvFile)) !== false) {
                                                $rows[] = $row;
                                            }
                                            fclose($csvFile);
                                            $hasData = !empty($headers) && !empty($rows);
                                        }
                                    }
                                } catch (\Exception $e) {
                                    $hasData = false;
                                }
                            @endphp

                            @if ($hasData)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                @foreach ($headers as $header)
                                                    <th scope="col"
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ $header }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            @foreach ($rows as $row)
                                                <tr>
                                                    @foreach ($row as $cell)
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $cell }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="p-4 bg-yellow-50">
                                    <p class="text-yellow-700">File CSV tidak dapat ditampilkan. Silakan unduh file
                                        untuk melihat isinya.</p>
                                </div>
                            @endif
                        @else
                            <div class="p-4 bg-gray-50">
                                <p class="text-gray-700">
                                    Pratinjau tidak tersedia untuk tipe file ini. Silakan unduh file untuk melihat
                                    isinya.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('finance-documents.edit', $document->id) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit
                    </a>
                    <form action="{{ route('finance-documents.destroy', $document->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
