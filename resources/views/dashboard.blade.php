<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Total Arsip Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 bg-opacity-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg font-semibold text-gray-800">Total Arsip</h3>
                                <div class="flex items-center">
                                    <span class="text-3xl font-bold text-gray-800">{{ $totalArchives }}</span>
                                    <span class="ml-2 text-sm text-gray-600">dokumen</span>
                                </div>
                                <a href="{{ route('finance-documents.index') }}" class="text-sm text-blue-500 hover:text-blue-600 mt-1 inline-block">
                                    Lihat semua arsip →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Kategori Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 bg-opacity-10">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg font-semibold text-gray-800">Total Kategori</h3>
                                <div class="flex items-center">
                                    <span class="text-3xl font-bold text-gray-800">{{ $totalCategories }}</span>
                                    <span class="ml-2 text-sm text-gray-600">kategori</span>
                                </div>
                                <a href="{{ route('categories.create') }}" class="text-sm text-green-500 hover:text-green-600 mt-1 inline-block">
                                    Kelola kategori →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Welcome Message -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">Selamat Datang di SIARDIKU</h3>
                    <p class="text-gray-600">
                        Gunakan menu di sidebar untuk mengelola arsip dan kategori dokumen keuangan Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
