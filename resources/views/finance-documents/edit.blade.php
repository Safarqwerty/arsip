<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-800">Edit Arsip</h1>
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
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('finance-documents.update', $document->id) }}" method="POST"
                enctype="multipart/form-data" class="bg-white p-8 rounded-xl shadow-2xl border border-gray-100">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="kode_arsip" class="block text-sm font-medium text-gray-700 mb-2">Kode Arsip</label>
                        <input type="text" name="kode_arsip" id="kode_arsip"
                            value="{{ old('kode_arsip', $document->kode_arsip) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                        @error('kode_arsip')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nama_arsip" class="block text-sm font-medium text-gray-700 mb-2">Nama Arsip</label>
                        <input type="text" name="nama_arsip" id="nama_arsip"
                            value="{{ old('nama_arsip', $document->nama_arsip) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">
                        @error('nama_arsip')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <div class="relative">
                            <select name="kategori" id="kategori" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none transition duration-300">
                                <option value="">Pilih Kategori</option>
                                <option value="SP2D" {{ $document->kategori == 'SP2D' ? 'selected' : '' }}>SP2D
                                </option>
                                <option value="SPM" {{ $document->kategori == 'SPM' ? 'selected' : '' }}>SPM</option>
                                <option value="SPBy" {{ $document->kategori == 'SPBy' ? 'selected' : '' }}>SPBy
                                </option>
                                <option value="SPP" {{ $document->kategori == 'SPP' ? 'selected' : '' }}>SPP</option>
                                <option value="SSP" {{ $document->kategori == 'SSP' ? 'selected' : '' }}>SSP
                                </option>
                                <option value="FORM PERMINTAAN"
                                    {{ $document->kategori == 'FORM PERMINTAAN' ? 'selected' : '' }}>FORM PERMINTAAN
                                </option>
                                <option value="SURAT TUGAS"
                                    {{ $document->kategori == 'SURAT TUGAS' ? 'selected' : '' }}>SURAT TUGAS</option>
                                <option value="SPD DAN BUKTI VISUM"
                                    {{ $document->kategori == 'SPD DAN BUKTI VISUM' ? 'selected' : '' }}>SPD DAN BUKTI
                                    VISUM</option>
                                <option value="PRESENSI DAN UANG MAKAN"
                                    {{ $document->kategori == 'PRESENSI DAN UANG MAKAN' ? 'selected' : '' }}>PRESENSI
                                    DAN UANG MAKAN</option>
                                <option value="SURAT PERNYATAAN"
                                    {{ $document->kategori == 'SURAT PERNYATAAN' ? 'selected' : '' }}>SURAT PERNYATAAN
                                </option>
                                <option value="LAPORAN PERJADIN"
                                    {{ $document->kategori == 'LAPORAN PERJADIN' ? 'selected' : '' }}>LAPORAN PERJADIN
                                </option>
                                <option value="DAFTAR RILL"
                                    {{ $document->kategori == 'DAFTAR RILL' ? 'selected' : '' }}>DAFTAR RILL</option>
                                <option value="DAFTAR GAJI"
                                    {{ $document->kategori == 'DAFTAR GAJI' ? 'selected' : '' }}>DAFTAR GAJI</option>
                                <option value="UNDANGAN" {{ $document->kategori == 'UNDANGAN' ? 'selected' : '' }}>
                                    UNDANGAN</option>
                                <option value="DRPP" {{ $document->kategori == 'DRPP' ? 'selected' : '' }}>DRPP
                                </option>
                                <option value="KAK" {{ $document->kategori == 'KAK' ? 'selected' : '' }}>KAK
                                </option>
                                <option value="BERITA ACARA"
                                    {{ $document->kategori == 'BERITA ACARA' ? 'selected' : '' }}>BERITA ACARA</option>
                                <option value="RINCIAN PERJADIN"
                                    {{ $document->kategori == 'RINCIAN PERJADIN' ? 'selected' : '' }}>RINCIAN PERJADIN
                                </option>
                                <option value="SPJ" {{ $document->kategori == 'SPJ' ? 'selected' : '' }}>SPJ
                                </option>
                                <option value="SK KPA" {{ $document->kategori == 'SK KPA' ? 'selected' : '' }}>SK KPA
                                </option>
                                <option value="BUKTI PEMBAYARAN"
                                    {{ $document->kategori == 'BUKTI PEMBAYARAN' ? 'selected' : '' }}>BUKTI PEMBAYARAN
                                </option>
                                <option value="DAFTAR REKAP"
                                    {{ $document->kategori == 'DAFTAR REKAP' ? 'selected' : '' }}>DAFTAR REKAP</option>
                                <option value="LAINNYA" {{ $document->kategori == 'LAINNYA' ? 'selected' : '' }}>
                                    LAINNYA</option>
                            </select>
                        </div>
                        @error('kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300">{{ old('keterangan', $document->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Upload File</label>
                        <div
                            class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition duration-300">
                            <input type="file" name="file" id="file"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                onchange="updateFileName(this)">
                            <div class="space-y-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-sm text-gray-600" id="file-name">
                                    @if ($document->file_path)
                                        {{ basename($document->file_path) }}
                                    @else
                                        Klik untuk memilih file
                                    @endif
                                </p>
                            </div>
                        </div>
                        @error('file')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 inline-block"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function updateFileName(input) {
                const fileName = document.getElementById('file-name');
                if (input.files && input.files.length > 0) {
                    fileName.textContent = input.files[0].name;
                } else {
                    fileName.textContent = 'Klik untuk memilih file';
                }
            }
        </script>
    @endpush
</x-app-layout>
