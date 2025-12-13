<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Surat Sakit - PT. PPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <!-- Desktop & Tablet: Fullscreen -->
    <div class="hidden md:flex h-screen flex-col">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-6 px-8">
            <div class="flex items-center justify-center">
                <img src="{{ asset('images/logo-ppa.png') }}" alt="Logo PPA" class="w-12 h-12 mr-4">
                <div>
                    <h1 class="text-3xl font-bold">Download Surat Sakit</h1>
                    <p class="text-blue-100">PT. Putra Perkasa Abadi</p>
                </div>
            </div>
        </div>

        <!-- Main Content - 2 Columns -->
        <div class="flex-1 grid grid-cols-2 overflow-hidden">
            <!-- Left Column - QR Code -->
            <div
                class="bg-gradient-to-br from-blue-50 to-purple-50 flex flex-col items-center justify-center p-8 border-r border-blue-200">
                <div class="text-center w-full max-w-md">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Scan QR Code</h2>

                    <div class="bg-white p-10 rounded-3xl shadow-2xl border-4 border-blue-300 inline-block">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=320x320&data={{ urlencode(url('/download')) }}"
                            alt="QR Code" width="320" height="320">
                    </div>

                    <div class="mt-8">
                        <p class="text-lg text-gray-700 font-semibold mb-4">Arahkan kamera HP ke QR Code</p>
                        <div
                            class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-full text-sm font-bold shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Gunakan Kamera HP
                        </div>
                    </div>

                    <div class="mt-8 bg-white rounded-xl p-5 border-2 border-blue-200 shadow-lg">
                        <p class="text-sm text-gray-700">
                            <span class="font-bold text-blue-600 text-base">💡 Tips:</span><br>
                            Buka aplikasi kamera, arahkan ke QR Code,<br>tunggu notifikasi muncul
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Form Input -->
            <div class="bg-white flex flex-col items-center justify-center p-8">
                <div class="w-full max-w-md">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-900 mb-3">Masukkan Kode Download</h2>
                        <p class="text-gray-600">Dapatkan kode dari petugas klinik</p>
                    </div>

                    @if ($errors->any())
                        <div
                            class="bg-red-50 border-2 border-red-200 text-red-800 px-5 py-4 rounded-xl mb-6 flex items-center shadow-lg">
                            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium">{{ $errors->first('short_code') }}</span>
                        </div>
                    @endif

                    @if (session('success'))
                        <div
                            class="bg-green-50 border-2 border-green-200 text-green-800 px-5 py-4 rounded-xl mb-6 flex items-center shadow-lg">
                            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('surat.download.submit') }}" method="POST">
                        @csrf

                        <div class="mb-8">
                            <label for="short_code"
                                class="block text-base font-bold text-gray-700 mb-4 flex items-center justify-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                Kode Download (4 Karakter)
                            </label>

                            <input type="text" id="short_code" name="short_code" maxlength="4" placeholder="A1B2"
                                value="{{ old('short_code') }}"
                                class="w-full px-8 py-6 border-4 border-gray-300 rounded-2xl text-center text-4xl font-bold tracking-widest uppercase focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 shadow-lg"
                                required autofocus>
                        </div>

                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-5 px-8 rounded-2xl transition-all transform hover:scale-105 shadow-2xl flex items-center justify-center text-xl">
                            <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download Surat Sakit
                        </button>
                    </form>

                    <!-- Instructions -->
                    <div
                        class="mt-8 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border-2 border-blue-200 shadow-lg">
                        <div class="flex items-start">
                            <svg class="w-7 h-7 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div class="text-sm text-blue-800">
                                <p class="font-bold mb-3 text-base">Cara Download:</p>
                                <ol class="list-decimal list-inside space-y-2 text-blue-700">
                                    <li>Dapatkan kode 4 karakter dari petugas klinik</li>
                                    <li>Masukkan kode di form ini</li>
                                    <li>Klik tombol "Download Surat Sakit"</li>
                                    <li>File PDF akan otomatis terunduh</li>
                                </ol>
                                <p class="mt-4 font-bold text-blue-900">💡 Lupa kode? Hubungi petugas klinik</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 bg-yellow-50 border-2 border-yellow-200 rounded-xl p-4 shadow-lg">
                        <p class="text-sm text-yellow-800 text-center font-semibold">
                            ⚠️ Surat dapat diunduh berkali-kali dengan kode yang sama
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-800 text-white py-3 px-8">
            <div class="bg-gray-800 text-white py-3 px-8">
                <p class="text-xs text-center text-gray-300">
                    © {{ date('Y') }} PT. Putra Perkasa Abadi - Sistem Manajemen Surat Sakit
                </p>
                <p class="text-xs text-center text-gray-500 mt-1">
                    developed by @medik Hidayatullah
                </p>
            </div>
        </div>
    </div>

    <!-- Mobile: Scrollable -->
    <div class="md:hidden min-h-screen">
        <!-- Header Mobile -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-6 px-4 sticky top-0 z-10 shadow-lg">
            <div class="text-center">
                <div class="flex items-center justify-center mb-2">
                    <img src="{{ asset('images/logo-ppa.png') }}" alt="Logo PPA" class="w-10 h-10">
                </div>
                <h1 class="text-2xl font-bold">Download Surat Sakit</h1>
                <p class="text-sm text-blue-100">PT. Putra Perkasa Abadi</p>

            </div>
        </div>

        <!-- Content Mobile -->
        <div class="p-4 pb-20">
            <!-- Form Input Mobile -->
            <div class="bg-white rounded-2xl shadow-xl p-6 mb-4">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Masukkan Kode Download</h2>
                    <p class="text-sm text-gray-600">Dapatkan kode dari petugas klinik</p>
                </div>

                @if ($errors->any())
                    <div
                        class="bg-red-50 border-2 border-red-200 text-red-800 px-4 py-3 rounded-xl mb-4 flex items-start">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm font-medium">{{ $errors->first('short_code') }}</span>
                    </div>
                @endif

                <form action="{{ route('surat.download.submit') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="short_code_mobile" class="block text-sm font-bold text-gray-700 mb-3 text-center">
                            <svg class="w-5 h-5 inline-block mr-1 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            Kode Download (4 Karakter)
                        </label>

                        <input type="text" id="short_code_mobile" name="short_code" maxlength="4"
                            placeholder="A1B2" value="{{ old('short_code') }}"
                            class="w-full px-6 py-5 border-3 border-gray-300 rounded-xl text-center text-3xl font-bold tracking-widest uppercase focus:ring-4 focus:ring-blue-500 focus:border-blue-500 bg-gray-50 shadow-lg"
                            required autofocus>
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-blue-700 active:from-blue-700 active:to-blue-800 text-white font-bold py-4 px-6 rounded-xl shadow-xl flex items-center justify-center text-lg">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download Surat Sakit
                    </button>
                </form>
            </div>

            <!-- QR Code Mobile -->
            <div
                class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl shadow-xl p-6 border-2 border-blue-200">
                <div class="text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Atau Scan QR Code</h3>

                    <div class="bg-white p-6 rounded-2xl shadow-lg inline-block border-4 border-blue-300">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data={{ urlencode(url('/download')) }}"
                            alt="QR Code" width="220" height="220">
                    </div>

                    <div class="mt-4">
                        <div
                            class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-full text-xs font-bold">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            Gunakan Kamera HP
                        </div>
                    </div>
                </div>
            </div>

            <!-- Instructions Mobile -->
            <div
                class="mt-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-5 border-2 border-blue-200 shadow-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div class="text-sm text-blue-800">
                        <p class="font-bold mb-2">Cara Download:</p>
                        <ol class="list-decimal list-inside space-y-1.5 text-blue-700 text-xs">
                            <li>Dapatkan kode 4 karakter dari petugas klinik</li>
                            <li>Masukkan kode di form atas</li>
                            <li>Klik tombol "Download Surat Sakit"</li>
                            <li>File PDF akan otomatis terunduh</li>
                        </ol>
                        <p class="mt-3 font-bold text-blue-900 text-xs">💡 Lupa kode? Hubungi petugas klinik</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 bg-yellow-50 border-2 border-yellow-200 rounded-xl p-4 shadow-lg">
                <p class="text-xs text-yellow-800 text-center font-semibold">
                    ⚠️ Surat dapat diunduh berkali-kali dengan kode yang sama
                </p>
            </div>
        </div>

        <!-- Footer Mobile -->
        <div class="fixed bottom-0 left-0 right-0 bg-gray-800 text-white py-3 px-4">
            <p class="text-xs text-center text-gray-300">
                © {{ date('Y') }} PT. Putra Perkasa Abadi
            </p>
            <p class="text-xs text-center text-gray-500 mt-1">
                Code by Ns. Hidayatullah
            </p>
        </div>
    </div>

    <script>
        // Auto uppercase input
        const inputs = document.querySelectorAll('input[name="short_code"]');
        inputs.forEach(input => {
            input.addEventListener('input', function(e) {
                e.target.value = e.target.value.toUpperCase();
            });
        });
    </script>
</body>

</html>
