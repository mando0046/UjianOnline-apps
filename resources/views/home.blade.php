<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 px-4">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-2xl p-10 flex flex-col md:flex-row items-center gap-8">

            <!-- Ilustrasi -->
            <div class="flex-1 flex justify-center">
                <img src="https://undraw.co/api/illustrations/chatting.svg" alt="Guest Illustration" class="w-72 md:w-96">
            </div>

            <!-- Konten -->
            <div class="flex-1 text-center md:text-left">
                <!-- Judul -->
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Selamat Datang 👋</h1>
                <p class="text-gray-600 mb-6">
                    Halaman ini adalah halaman <span class="font-semibold">guest</span> untuk menjadi peserta ujian.
                    Silakan hubungi admin untuk mendapatkan akses login.
                </p>

                <!-- Info WhatsApp -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-5 mb-6">
                    <p class="text-gray-700 text-lg mb-2 font-medium">
                        📱 Hubungi Admin via WhatsApp:
                    </p>
                    <a href="https://wa.me/628234143666" target="_blank"
                        class="inline-flex items-center justify-center w-full py-3 px-5 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.031-.967-.273-.099-.472-.149-.672.15-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.372-.025-.521-.075-.149-.672-1.611-.921-2.207-.242-.579-.487-.5-.672-.51-.173-.008-.372-.01-.571-.01-.198 0-.52.074-.793.372-.272.298-1.04 1.016-1.04 2.479s1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z" />
                        </svg>
                        08234143666
                    </a>
                </div>

                <!-- Pesan konfirmasi -->
                <p class="text-gray-600 mb-6">
                    Setelah <span class="font-semibold">admin mengkonfirmasi</span>, silakan login menggunakan akun yang
                    telah diberikan.
                </p>

                <!-- Tombol Login -->
                <a href="{{ route('login') }}"
                    class="w-full inline-block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg shadow transition">
                    🔑 Login
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
