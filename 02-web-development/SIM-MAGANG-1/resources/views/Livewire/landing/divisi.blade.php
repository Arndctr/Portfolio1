<div class="bg-gradient-to-b from-gray-50 to-white">

    {{-- ================= HERO ================= --}}
    <section class="pt-12 pb-16 px-6 lg:px-20 text-center">
        <div class="max-w-3xl mx-auto space-y-5">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight">
                Divisi Magang
            </h1>
            <p class="text-gray-600 md:text-lg">
                Pilih divisi yang sesuai dengan minat dan kompetensi Anda.
                Setiap divisi menawarkan pengalaman unik untuk pengembangan profesional.
            </p>
        </div>
    </section>

    {{-- ================= LIST DIVISI ================= --}}
    <section class="pb-20">
        <div class="max-w-6xl mx-auto px-6 space-y-10">

            {{-- CARD STYLE REUSABLE --}}
            @php
                $cardStyle = "group bg-white/80 backdrop-blur-sm p-8 rounded-3xl border border-gray-100 
                              shadow-sm hover:shadow-xl hover:-translate-y-1 
                              transition-all duration-300";
            @endphp

            {{-- ================= SOCIAL MEDIA ================= --}}
            <div class="{{ $cardStyle }}">
                <div class="flex flex-col md:flex-row gap-8">

                    <div class="flex items-start justify-center md:justify-start">
                        <div class="bg-blue-50 p-4 rounded-2xl group-hover:scale-110 transition">
                            <img src="{{ asset('images/Icon-6.svg') }}"
                                loading="lazy" decoding="async"
                                class="w-14 h-14 object-contain">
                        </div>
                    </div>

                    <div class="flex-1 space-y-6">

                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                Social Media Specialist
                            </h2>
                            <p class="text-gray-600 mt-2 leading-relaxed">
                                Mengelola strategi dan konten media sosial untuk meningkatkan branding dan engagement.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Tanggung Jawab:</h3>
                            <ul class="list-disc pl-5 space-y-1 text-gray-600">
                                <li>Membuat dan menjadwalkan konten</li>
                                <li>Mengelola Instagram & platform lainnya</li>
                                <li>Menganalisis performa konten</li>
                                <li>Meningkatkan engagement audience</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-3">Keterampilan yang Dibutuhkan:</h3>
                            <div class="flex flex-wrap gap-3">
                                <span class="skill-blue">Content Planning</span>
                                <span class="skill-blue">Copywriting</span>
                                <span class="skill-blue">Social Media Analytics</span>
                                <span class="skill-blue">Kreatif & Komunikatif</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {{-- ================= GRAPHIC DESIGN ================= --}}
            <div class="{{ $cardStyle }}">
                <div class="flex flex-col md:flex-row gap-8">

                    <div class="flex items-start justify-center md:justify-start">
                        <div class="bg-purple-50 p-4 rounded-2xl group-hover:scale-110 transition">
                            <img src="{{ asset('images/Icon-8.svg') }}"
                                loading="lazy" decoding="async"
                                class="w-14 h-14 object-contain">
                        </div>
                    </div>

                    <div class="flex-1 space-y-6">

                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                Graphic Design
                            </h2>
                            <p class="text-gray-600 mt-2 leading-relaxed">
                                Mendesain materi visual untuk kebutuhan promosi dan branding.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Tanggung Jawab:</h3>
                            <ul class="list-disc pl-5 space-y-1 text-gray-600">
                                <li>Mendesain konten media sosial</li>
                                <li>Membuat poster & banner event</li>
                                <li>Mengelola branding visual</li>
                                <li>Editing foto & video ringan</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-3">Keterampilan yang Dibutuhkan:</h3>
                            <div class="flex flex-wrap gap-3">
                                <span class="skill-purple">Adobe Photoshop</span>
                                <span class="skill-purple">Adobe Illustrator</span>
                                <span class="skill-purple">Kreativitas Visual</span>
                                <span class="skill-purple">Layout Design</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {{-- ================= EVENT SPECIALIST ================= --}}
            <div class="{{ $cardStyle }}">
                <div class="flex flex-col md:flex-row gap-8">

                    <div class="flex items-start justify-center md:justify-start">
                        <div class="bg-orange-50 p-4 rounded-2xl group-hover:scale-110 transition">
                            <img src="{{ asset('images/Icon-9.svg') }}"
                                loading="lazy" decoding="async"
                                class="w-14 h-14 object-contain">
                        </div>
                    </div>

                    <div class="flex-1 space-y-6">

                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                Event Specialist 
                            </h2>
                            <p class="text-gray-600 mt-2 leading-relaxed">
                                Mengelola perencanaan dan pelaksanaan event Rumah BUMN.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Tanggung Jawab:</h3>
                            <ul class="list-disc pl-5 space-y-1 text-gray-600">
                                <li>Merancang konsep acara</li>
                                <li>Mengelola vendor & kebutuhan event</li>
                                <li>Mengkoordinasikan tim</li>
                                <li>Evaluasi hasil event</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-3">Keterampilan yang Dibutuhkan:</h3>
                            <div class="flex flex-wrap gap-3">
                                <span class="skill-orange">Event Management</span>
                                <span class="skill-orange">Project Coordination</span>
                                <span class="skill-orange">Leadership</span>
                                <span class="skill-orange">Problem Solving</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {{-- ================= SME RELATION ================= --}}
            <div class="{{ $cardStyle }}">
                <div class="flex flex-col md:flex-row gap-8">

                    <div class="flex items-start justify-center md:justify-start">
                        <div class="bg-green-50 p-4 rounded-2xl group-hover:scale-110 transition">
                            <img src="{{ asset('images/Icon-10.svg') }}"
                                loading="lazy" decoding="async"
                                class="w-14 h-14 object-contain">
                        </div>
                    </div>

                    <div class="flex-1 space-y-6">

                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">
                                SME Relation
                            </h2>
                            <p class="text-gray-600 mt-2 leading-relaxed">
                                Mengelola hubungan dan kemitraan dengan UMKM mitra.
                            </p>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-2">Tanggung Jawab:</h3>
                            <ul class="list-disc pl-5 space-y-1 text-gray-600">
                                <li>Membangun relasi dengan UMKM</li>
                                <li>Mengidentifikasi peluang kolaborasi</li>
                                <li>Menyusun program pemberdayaan</li>
                                <li>Monitoring perkembangan mitra</li>
                            </ul>
                        </div>

                        <div>
                            <h3 class="font-semibold text-gray-800 mb-3">Keterampilan yang Dibutuhkan:</h3>
                            <div class="flex flex-wrap gap-3">
                                <span class="skill-green">Komunikasi & Negosiasi</span>
                                <span class="skill-green">Business Development</span>
                                <span class="skill-green">Relationship Management</span>
                                <span class="skill-green">Analisis Bisnis</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    {{-- ================= CTA IMPROVED ================= --}}
    <section class="px-6 md:px-12 lg:px-20 pb-20">
    <div class="relative bg-linear-to-r from-blue-600 via-blue-700 to-blue-800 
                rounded-2xl py-10 md:py-12 px-6 md:px-10 
                text-center text-white shadow-xl overflow-hidden space-y-4">
      <h2 class="text-3xl md:text-4xl font-bold ">
        Sudah Menemukan Divisi yang Cocok?
      </h2>
      <p class="relative text-lg text-blue-100 leading-relaxed max-w-2xl mx-auto">
        Segera daftarkan diri Anda dan pilih hingga 
        <span class="font-semibold text-white">2 divisi terbaik</span> 
        sesuai minat dan kemampuan Anda.
      </p>
      
      <a href="{{ route('daftar') }}"
        class="bg-yellow-400 text-black px-8 py-3 rounded-lg font-medium hover:bg-yellow-500 transition inline-block">
        Mulai Daftar
        </a>
    </div>
  </section>


</div>
