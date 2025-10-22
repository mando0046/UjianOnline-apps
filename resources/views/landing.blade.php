<x-app-layout>
    <div class="min-h-screen bg-gray-100 flex flex-col">

        <!-- Hero Section -->
        <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto px-6 py-16 md:py-24 gap-10">

            <!-- Text Content -->
            <div class="md:w-1/2 flex flex-col justify-center space-y-6">
                <h1 class="text-5xl md:text-6xl font-bold text-green-700">
                    Ujian Online
                </h1>

                {{-- Guest (belum login) --}}
                @guest
                    <p class="text-lg text-gray-700">
                        Selamat datang di platform <span class="font-semibold text-green-700">Ujian Online</span>. <br>
                        Login atau daftar sekarang untuk mengikuti ujian dengan mudah dan cepat.
                    </p>

                    <!-- Tombol login & register hanya untuk guest -->
                    <div class="flex flex-wrap gap-4 mt-4">
                        <a href="{{ route('login') }}"
                            class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg font-semibold shadow hover:from-green-700 hover:to-green-800 transition-all duration-300">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                            class="px-6 py-3 bg-gray-700 text-white rounded-lg font-semibold shadow hover:bg-gray-800 transition-all duration-300">
                            Register
                        </a>
                    </div>
                @endguest

                {{-- Authenticated user --}}
                @auth
                    @if (Auth::user()->role === 'admin')
                        <p class="text-lg text-gray-700">
                            Selamat datang, <span class="font-semibold text-green-700">{{ Auth::user()->name }}</span>!<br>
                            Anda login sebagai <span class="font-semibold">Admin</span>.
                        </p>

                        <a href="{{ route('admin.dashboard') }}"
                            class="mt-4 inline-block px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold shadow transition-all duration-300">
                            Masuk ke Dashboard Admin
                        </a>
                    @elseif(Auth::user()->role === 'peserta')
                        <p class="text-lg text-gray-700">
                            Selamat datang, <span class="font-semibold text-green-700">{{ Auth::user()->name }}</span>!<br>
                            Anda login sebagai <span class="font-semibold">Peserta</span>. <br>
                            Silakan masuk ke dashboard untuk memulai ujian.
                        </p>

                        <a href="{{ route('peserta.index') }}"
                            class="mt-4 inline-block px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold shadow transition-all duration-300">
                            Masuk ke Dashboard Peserta
                        </a>
                    @elseif(Auth::user()->role === 'guest')
                        <p class="text-lg text-gray-700">
                            Selamat datang, <span class="font-semibold text-green-700">{{ Auth::user()->name }}</span>!<br>
                            Anda login sebagai <span class="font-semibold">Guest</span>.
                        </p>

                        <div class="mt-4 space-y-3">
                            <p class="text-gray-600">
                                Ingin menjadi peserta ujian? Hubungi admin melalui WhatsApp berikut:
                            </p>
                            <a href="https://wa.me/62812341436666?text=Halo%20Admin,%20saya%20ingin%20menjadi%20peserta%20ujian."
                                target="_blank"
                                class="inline-block px-6 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg font-semibold shadow transition-all duration-300">
                                💬 Hubungi Admin via WhatsApp
                            </a>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Illustration Image -->
            <div class="md:w-1/2 flex justify-center">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Online Exam Illustration"
                    class="w-80 md:w-96 object-contain">
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white py-12 mt-10">
            <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6 border rounded-lg shadow-sm hover:shadow-lg transition-all duration-300">
                    <h3 class="text-xl font-semibold mb-2">Mudah Digunakan</h3>
                    <p class="text-gray-600">Interface yang sederhana dan cepat dipahami.</p>
                </div>
                <div class="p-6 border rounded-lg shadow-sm hover:shadow-lg transition-all duration-300">
                    <h3 class="text-xl font-semibold mb-2">Aman & Terpercaya</h3>
                    <p class="text-gray-600">Data ujian dan peserta aman tersimpan di server.</p>
                </div>
                <div class="p-6 border rounded-lg shadow-sm hover:shadow-lg transition-all duration-300">
                    <h3 class="text-xl font-semibold mb-2">Hasil Cepat</h3>
                    <p class="text-gray-600">Laporan hasil ujian bisa langsung diunduh.</p>
                </div>
            </div>
        </div>

        {{-- <!-- Footer -->
        <footer class="mt-auto bg-gray-200 py-4 text-center text-gray-600 text-sm">
            &copy; {{ date('Y') }} Ujian Online. Programmer by <b>Mando Ubuntu</b>.
        </footer> --}}
    </div>
</x-app-layout>
