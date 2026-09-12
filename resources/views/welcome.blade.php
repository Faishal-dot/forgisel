<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>For My Baby :3</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen overflow-hidden bg-[#080506] text-white">

    <!-- Background -->
    <div class="fixed inset-0 -z-10 overflow-hidden">

        <div class="absolute left-1/2 top-1/2
                    h-[500px] w-[500px]
                    -translate-x-1/2 -translate-y-1/2
                    rounded-full
                    bg-red-900/20
                    blur-[130px]">
        </div>

        <div class="absolute -left-40 -top-40
                    h-[400px] w-[400px]
                    rounded-full
                    bg-rose-950/30
                    blur-[120px]">
        </div>

        <div class="absolute -bottom-40 -right-40
                    h-[400px] w-[400px]
                    rounded-full
                    bg-red-950/30
                    blur-[120px]">
        </div>

        <!-- subtle grid -->
        <div class="absolute inset-0 opacity-[0.035]"
             style="
                background-image:
                linear-gradient(rgba(255,255,255,.5) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.5) 1px, transparent 1px);
                background-size: 50px 50px;
             ">
        </div>

    </div>


    <!-- MAIN -->
    <main class="relative flex min-h-screen items-center justify-center px-6">

        <!-- Initial Screen -->
        <section
            id="giftScreen"
            class="flex flex-col items-center text-center transition-all duration-700"
        >

            <p class="mb-3 text-xs font-medium uppercase tracking-[0.45em] text-rose-300/70">
                A little something for you
            </p>

            <h1 class="text-4xl font-semibold tracking-tight sm:text-6xl">
                For <span class="text-rose-400">Gisel</span>
            </h1>

            <p class="mt-4 max-w-md text-sm leading-7 text-white/50 sm:text-base">
                Ada sesuatu kecil yang aku siapin buat kamu.
                Coba buka hadiahnya.
            </p>


            <!-- GIFT -->
            <button
                id="giftButton"
                type="button"
                class="group relative mt-12
                       h-48 w-48
                       sm:h-56 sm:w-56
                       outline-none"
            >

                <!-- Glow -->
                <div class="absolute inset-4
                            rounded-full
                            bg-red-600/20
                            blur-3xl
                            transition duration-500
                            group-hover:bg-red-500/35">
                </div>


                <!-- Gift box -->
                <div
                    id="giftBox"
                    class="gift-box absolute left-1/2 top-1/2
                           h-32 w-36
                           -translate-x-1/2 -translate-y-1/2
                           sm:h-36 sm:w-40"
                >

                    <!-- Lid -->
                    <div
                        class="absolute left-[-5px] top-0
                               z-20
                               h-8 w-[calc(100%+10px)]
                               rounded-lg
                               border border-red-300/20
                               bg-gradient-to-b from-red-500 to-red-800
                               shadow-[0_15px_40px_rgba(150,0,20,.35)]
                               transition-transform duration-700
                               group-hover:-translate-y-2"
                        id="giftLid"
                    >

                        <!-- Ribbon -->
                        <div class="absolute left-1/2 top-0
                                    h-full w-6
                                    -translate-x-1/2
                                    bg-gradient-to-r
                                    from-red-300/70
                                    via-red-100/80
                                    to-red-300/70">
                        </div>

                    </div>


                    <!-- Body -->
                    <div
                        class="absolute bottom-0 left-1/2
                               h-28 w-36
                               -translate-x-1/2
                               overflow-hidden
                               rounded-b-xl
                               border border-red-300/20
                               bg-gradient-to-br
                               from-red-500
                               via-red-700
                               to-red-950
                               shadow-[0_25px_60px_rgba(120,0,20,.45)]
                               sm:h-32 sm:w-40"
                    >

                        <!-- Ribbon vertical -->
                        <div class="absolute left-1/2 top-0
                                    h-full w-6
                                    -translate-x-1/2
                                    bg-gradient-to-r
                                    from-red-300/70
                                    via-red-100/80
                                    to-red-300/70">
                        </div>

                        <!-- Shine -->
                        <div class="absolute inset-y-0 left-4
                                    w-8
                                    bg-white/10
                                    blur-xl">
                        </div>

                    </div>


                    <!-- Bow -->
                    <div
                        id="giftBow"
                        class="absolute -top-8 left-1/2
                               z-30
                               flex -translate-x-1/2
                               items-center
                               transition-all duration-700"
                    >

                        <div class="h-9 w-14
                                    -rotate-12
                                    rounded-full
                                    rounded-br-none
                                    border border-red-200/20
                                    bg-gradient-to-br
                                    from-red-300
                                    to-red-700
                                    shadow-lg">
                        </div>

                        <div class="h-9 w-14
                                    rotate-12
                                    rounded-full
                                    rounded-bl-none
                                    border border-red-200/20
                                    bg-gradient-to-bl
                                    from-red-300
                                    to-red-700
                                    shadow-lg">
                        </div>

                        <div class="absolute left-1/2 top-1/2
                                    h-6 w-6
                                    -translate-x-1/2
                                    -translate-y-1/2
                                    rounded-full
                                    bg-red-400
                                    shadow-lg">
                        </div>

                    </div>

                </div>


                <!-- Text -->
                <span
                    class="absolute -bottom-12 left-1/2
                           -translate-x-1/2
                           whitespace-nowrap
                           text-xs
                           tracking-[0.25em]
                           text-white/40
                           transition-colors
                           group-hover:text-rose-300/80"
                >
                    KLIK UNTUK MEMBUKA
                </span>

            </button>

        </section>


        <!-- ROSE EXPLOSION -->
        <div
            id="roseContainer"
            class="pointer-events-none absolute inset-0 overflow-hidden"
        >
        </div>


        <!-- MESSAGE BUTTON -->
        <section
            id="messageSection"
            class="pointer-events-none absolute inset-0
                   flex items-center justify-center
                   opacity-0
                   transition-all duration-1000"
        >

            <div class="flex flex-col items-center text-center">

                <div
                    class="mb-5
                           rounded-full
                           border border-white/10
                           bg-white/[0.04]
                           px-4 py-2
                           text-[10px]
                           uppercase
                           tracking-[0.35em]
                           text-rose-300/70
                           backdrop-blur-xl"
                >
                    Just for you
                </div>


                <h2 class="text-3xl font-semibold sm:text-5xl">
                    Ada pesan buat kamu
                </h2>

                <p class="mt-3 max-w-sm text-sm leading-6 text-white/40">
                    Aku sengaja bikin ini khusus buat kamu.
                </p>


                <!-- MENGGANTI TOMBOL TEKS MENJADI GAMBAR PESAN/AMPLOP -->
                <button
                    id="messageButton"
                    type="button"
                    class="group relative mt-10 flex h-20 w-28 items-center justify-center outline-none transition-all duration-300 hover:-translate-y-2 hover:scale-105 active:scale-95"
                >
                    <!-- Glow effect di belakang amplop -->
                    <div class="absolute inset-0 rounded-xl bg-rose-500/20 blur-xl transition-all duration-300 group-hover:bg-rose-500/50"></div>

                    <!-- Kotak Amplop -->
                    <div class="relative flex h-full w-full items-center justify-center rounded-xl border border-rose-300/30 bg-gradient-to-br from-rose-600 via-rose-700 to-red-900 shadow-[0_15px_40px_rgba(190,24,93,.4)]">
                        
                        <!-- Lipatan atas amplop (efek segitiga) -->
                        <div class="absolute top-0 h-0 w-0 border-l-[54px] border-r-[54px] border-t-[36px] border-l-transparent border-r-transparent border-t-white/10"></div>

                        <!-- Ikon Surat -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="z-10 h-10 w-10 text-rose-100 transition-transform duration-500 group-hover:scale-110" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916v-.243" />
                        </svg>
                    </div>

                    <!-- Notifikasi Titik Merah (Animasi melompat/bounce) -->
                    <span class="absolute -right-3 -top-3 z-20 flex h-7 w-7 animate-bounce items-center justify-center rounded-full border-2 border-[#080506] bg-red-500 text-[11px] font-bold text-white shadow-lg">
                        1
                    </span>

                    <!-- Teks instruksi klik -->
                    <span class="absolute -bottom-8 whitespace-nowrap text-[10px] tracking-widest text-white/40 transition-colors group-hover:text-rose-300">
                        KLIK UNTUK MEMBACA
                    </span>
                </button>

            </div>

        </section>


        <!-- MESSAGE CARD -->
        <section
            id="messageCard"
            class="pointer-events-none absolute inset-0
                   flex items-center justify-center
                   bg-black/20
                   px-5
                   opacity-0
                   transition-all duration-700"
        >

            <div
                class="relative w-full max-w-lg
                       translate-y-10
                       scale-95
                       rounded-[2rem]
                       border border-white/10
                       bg-white/[0.055]
                       p-7
                       shadow-[0_30px_100px_rgba(0,0,0,.5)]
                       backdrop-blur-2xl
                       transition-all duration-700"
                id="messageCardInner"
            >

                <!-- glow -->
                <div class="absolute -inset-1 -z-10
                            rounded-[2rem]
                            bg-gradient-to-br
                            from-rose-500/20
                            via-transparent
                            to-red-900/20
                            blur-xl">
                </div>


                <div class="mb-6 flex items-center justify-between">

                    <div>
                        <p class="text-[10px]
                                  uppercase
                                  tracking-[0.35em]
                                  text-rose-300/60">
                            For Raden Ayu Giselle
                        </p>

                        <h3 class="mt-2 text-2xl font-semibold">
                            Untuk kamu ❤️
                        </h3>
                    </div>

                    <div
                        class="flex h-11 w-11
                               items-center justify-center
                               rounded-full
                               border border-white/10
                               bg-white/5"
                    >
                        <span class="text-sm text-rose-300">✦</span>
                    </div>

                </div>


                <div class="space-y-4
                            text-sm
                            leading-7
                            text-white/65">

                    <p>
                        Hai Sayangg.
                    </p>

                    <p>
                        Mungkin ini cuma sebuah website kecil,
                        tapi aku bikin ini dengan niat yang besar.
                    </p>

                    <p>
                        Aku cuma mau bilang kalau aku bersyukur
                        bisa kenal dan punya kamu di hidupku.
                    </p>

                    <p>
                        Semoga sesederhana apa pun hal yang aku kasih,
                        kamu tetap bisa ngerasain kalau ini dibuat
                        khusus untuk kamu.
                    </p>

                    <p class="pt-2 text-white/85">
                        Terima kasih sudah menjadi seseorang
                        yang begitu berarti buat aku.
                    </p>

                </div>


                <div class="mt-8 border-t border-white/10 pt-5">

                    <p class="text-xs text-white/30">
                        With all my heart,
                    </p>

                    <p class="mt-1 text-sm font-medium text-rose-300">
                        Jova Liandri
                    </p>

                </div>

            </div>

        </section>

    </main>

    <!-- TAMBAHAN AUDIO UNTUK LAGU BRUNO MARS - RISK IT ALL -->
    <audio id="bgMusic" src="/music/risk_it_all.mp3"></audio>


    <script>

        const giftButton = document.getElementById('giftButton');
        const giftScreen = document.getElementById('giftScreen');

        const giftBox = document.getElementById('giftBox');
        const giftLid = document.getElementById('giftLid');
        const giftBow = document.getElementById('giftBow');

        const roseContainer = document.getElementById('roseContainer');

        const messageSection = document.getElementById('messageSection');
        const messageButton = document.getElementById('messageButton');

        const messageCard = document.getElementById('messageCard');
        const messageCardInner = document.getElementById('messageCardInner');

        // TAMBAHAN MENGAMBIL ELEMENT LAGU
        const bgMusic = document.getElementById('bgMusic');

        let opened = false;


        giftButton.addEventListener('click', () => {

            if (opened) return;

            opened = true;

            // TAMBAHAN UNTUK MEMUTAR LAGU SAAT HADIAH DIKLIK
            bgMusic.play().catch(err => console.log("Gagal memutar audio:", err));

            /*
             * 1. Buka tutup hadiah
             */
            giftLid.style.transform = 'translateY(-45px) rotate(-8deg)';
            giftBow.style.transform =
                'translateX(-50%) translateY(-25px) rotate(8deg)';


            /*
             * 2. Sedikit delay supaya
             * animasinya terasa seperti hadiah benar-benar dibuka
             */
            setTimeout(() => {

                giftBox.style.transform =
                    'translate(-50%, -50%) scale(0.75)';

                giftBox.style.opacity = '0';

            }, 450);


            /*
             * 3. Buat ledakan bunga
             */
            setTimeout(() => {
                createRoseExplosion();
            }, 550);


            /*
             * 4. Hilangkan halaman awal
             */
            setTimeout(() => {

                giftScreen.style.opacity = '0';
                giftScreen.style.transform =
                    'scale(.92) translateY(20px)';

                giftScreen.style.pointerEvents = 'none';

            }, 900);


            /*
             * 5. Tampilkan tombol pesan
             */
            setTimeout(() => {

                messageSection.style.opacity = '1';
                messageSection.style.pointerEvents = 'auto';

            }, 2600);

        });


        // ==========================================
        // BAGIAN YANG DIUBAH: FUNGSI LEDAKAN MAWAR (FULL SATU LAYAR & BANYAK)
        // ==========================================
        function createRoseExplosion() {

            // Jumlah mawar ditambah banyak agar memenuhi layar (70 sampai 110 bunga)
            const roseCount = window.innerWidth < 640 ? 70 : 110;

            for (let i = 0; i < roseCount; i++) {

                const rose = document.createElement('img');

                // Menggunakan 2 gambar: rose.png dan rose2.png secara acak (DIPERBAIKI)
                rose.src = Math.random() > 0.5 ? "/images/rose.png" : "/images/rose2.png";

                rose.className =
                    'absolute left-1/2 top-1/2 ' +
                    'h-10 w-10 object-contain ' +
                    'drop-shadow-[0_8px_15px_rgba(190,24,93,.35)]';

                /*
                 * Ukuran random agar bervariasi dan merata di seluruh layar
                 */
                const size =
                    Math.floor(Math.random() * 50) + 50; // Ukuran bunga antara 50px sampai 100px

                rose.style.width = `${size}px`;
                rose.style.height = `${size}px`;


                /*
                 * Arah ledakan full satu layar secara menyeluruh
                 */
                const angle =
                    Math.random() * Math.PI * 2;

                // Menghitung jarak maksimal agar menyebar hingga ujung sudut layar
                const maxDistance = Math.max(window.innerWidth, window.innerHeight) * 0.85;
                
                const distance =
                    Math.random() * maxDistance + 50; 

                const x =
                    Math.cos(angle) * distance;

                const y =
                    Math.sin(angle) * distance;


                /*
                 * Rotasi random
                 */
                const rotation =
                    Math.random() * 720 - 360;


                /*
                 * Delay random
                 */
                const delay =
                    Math.random() * 250;


                rose.style.setProperty('--rose-x', `${x}px`);
                rose.style.setProperty('--rose-y', `${y}px`);
                rose.style.setProperty('--rose-r', `${rotation}deg`);

                rose.style.animation =
                    `roseExplosion 1.8s cubic-bezier(.16,1,.3,1) ${delay}ms forwards`;


                roseContainer.appendChild(rose);


                /*
                 * Hapus setelah selesai
                 */
                setTimeout(() => {
                    rose.remove();
                }, 2100 + delay);

            }

        }
        // ==========================================


        /*
         * Tombol buka pesan (DIPERBAIKI DI SINI)
         */
        messageButton.addEventListener('click', () => {

            // MENYEMBUNYIKAN AMPLOP AGAR TIDAK TEMBUS PANDANG
            messageSection.style.opacity = '0';
            messageSection.style.pointerEvents = 'none';

            // MEMUNCULKAN KARTU PESAN
            messageCard.style.opacity = '1';
            messageCard.style.pointerEvents = 'auto';

            setTimeout(() => {

                messageCardInner.style.transform =
                    'translateY(0) scale(1)';

            }, 50);

        });


        /*
         * Klik background untuk menutup kartu (DIPERBAIKI DI SINI)
         */
        messageCard.addEventListener('click', (event) => {

            if (event.target === messageCard) {

                // MENUTUP KARTU PESAN
                messageCard.style.opacity = '0';
                messageCard.style.pointerEvents = 'none';

                messageCardInner.style.transform =
                    'translateY(40px) scale(.95)';

                // MEMUNCULKAN AMPLOP KEMBALI SETELAH KARTU DITUTUP
                setTimeout(() => {
                    messageSection.style.opacity = '1';
                    messageSection.style.pointerEvents = 'auto';
                }, 500);

            }

        });

    </script>

</body>

</html>