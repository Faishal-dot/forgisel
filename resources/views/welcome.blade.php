<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>For My Baby :3</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fallback Tailwind: keeps the UI styled even if the Vite CSS bundle is unavailable -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes roseExplosion {
            0% {
                transform: translate(-50%, -50%) scale(.15) rotate(0deg);
                opacity: 0;
            }
            12% {
                opacity: 1;
            }
            100% {
                transform: translate(
                    calc(-50% + var(--rose-x)),
                    calc(-50% + var(--rose-y))
                ) scale(1) rotate(var(--rose-r));
                opacity: 0;
            }
        }

        html {
            -webkit-text-size-adjust: 100%;
        }

        body {
            min-height: 100dvh;
        }

        button {
            -webkit-tap-highlight-color: transparent;
        }


        /* ==================================================
           SURAT: AMPLOP KRIM + PITA MERAH -> KERTAS DI DALAM AMPLOP
           (teks surat sekarang tampil DI DALAM amplop)
           ================================================== */
        .letter-scene {
            position: relative;
            width: min(88vw, 340px);
            height: min(78vh, 420px);
        }

        .cream-letter {
            position: absolute;
            inset: 0;
            border-radius: 20px;
            overflow: hidden;
        }

        .cream-letter-body {
            position: absolute;
            inset: 0;
            z-index: 1;
            overflow: hidden;
            border-radius: 20px;
            background: linear-gradient(150deg, #fff8e8, #f2dfb8 55%, #e9cf9e);
            border: 1px solid rgba(139, 91, 50, .3);
            box-shadow: 0 28px 70px rgba(0,0,0,.35);
        }

        .cream-letter-body::before {
            content: "";
            position: absolute;
            inset: 10px;
            border: 1px solid rgba(139,91,50,.18);
            border-radius: 12px;
        }

        /* Kertas isi surat, tersembunyi di dalam amplop sampai pita dibuka */
        .white-paper {
            position: absolute;
            inset: 16px;
            z-index: 2;
            overflow-y: auto;
            border-radius: 13px;
            background: #fffdf8;
            box-shadow: 0 10px 30px rgba(0,0,0,.18);
            padding: 22px 20px;
            opacity: 0;
            transform: scale(.35) translateY(10px);
            transform-origin: center;
        }

        .paper-content {
            text-align: left;
            font-family: Georgia, serif;
            opacity: 0;
            transform: translateY(8px);
        }

        .paper-label {
            display: block;
            font-size: 9px;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: #b3405a;
            margin-bottom: 6px;
        }

        .paper-title {
            display: block;
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 14px;
            color: #4a3527;
        }

        .paper-body p {
            font-size: 12.5px;
            line-height: 1.7;
            margin-bottom: 10px;
            color: #6b5340;
        }

        .paper-body p.paper-strong {
            color: #4a3527;
        }

        .paper-signoff {
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px solid rgba(139,91,50,.2);
        }

        .paper-signoff .signoff-label {
            display: block;
            font-size: 10px;
            color: #9c8266;
        }

        .paper-signoff .signoff-name {
            display: block;
            margin-top: 2px;
            font-size: 13px;
            font-weight: 600;
            color: #b3405a;
        }

        /* Pita merah yang menutupi surat sebelum dibuka */
        .ribbon-vertical,
        .ribbon-horizontal {
            position: absolute;
            inset: 0;
            z-index: 3;
            pointer-events: none;
        }

        .ribbon-v-top,
        .ribbon-v-bottom {
            position: absolute;
            left: 50%;
            width: 28px;
            height: 50%;
            transform: translateX(-50%);
            background: linear-gradient(180deg, #f0537a, #b30e35);
            box-shadow: 0 2px 10px rgba(0,0,0,.25);
        }

        .ribbon-v-top {
            top: 0;
            border-radius: 4px 4px 0 0;
        }

        .ribbon-v-bottom {
            bottom: 0;
            border-radius: 0 0 4px 4px;
        }

        .ribbon-h-left,
        .ribbon-h-right {
            position: absolute;
            top: 50%;
            height: 28px;
            width: 50%;
            transform: translateY(-50%);
            background: linear-gradient(90deg, #f0537a, #b30e35);
            box-shadow: 0 2px 10px rgba(0,0,0,.25);
        }

        .ribbon-h-left {
            left: 0;
            border-radius: 4px 0 0 4px;
        }

        .ribbon-h-right {
            right: 0;
            border-radius: 0 4px 4px 0;
        }

        .ribbon-bow {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 4;
            width: 62px;
            height: 40px;
            transform: translate(-50%, -50%);
        }

        .bow-wing {
            position: absolute;
            top: 0;
            width: 29px;
            height: 29px;
            border-radius: 50% 50% 50% 0;
            background: linear-gradient(145deg, #ff6a8f, #b30e35);
            box-shadow: 0 5px 12px rgba(150,0,20,.35);
        }

        .bow-wing-left {
            left: 0;
            transform: rotate(-25deg);
        }

        .bow-wing-right {
            right: 0;
            transform: rotate(25deg) scaleX(-1);
        }

        .bow-knot {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: #e52a55;
            transform: translate(-50%, -50%);
            box-shadow: 0 2px 6px rgba(0,0,0,.3);
        }

        /* ---------- Animasi buka pita: mundur perlahan sampai habis (tidak pecah/berputar) ---------- */
        @keyframes ribbonRetreatUp {
            0%   { transform: translate(-50%, 0); }
            100% { transform: translate(-50%, -105%); }
        }

        @keyframes ribbonRetreatDown {
            0%   { transform: translate(-50%, 0); }
            100% { transform: translate(-50%, 105%); }
        }

        @keyframes ribbonRetreatLeft {
            0%   { transform: translateY(-50%) translateX(0); }
            100% { transform: translateY(-50%) translateX(-105%); }
        }

        @keyframes ribbonRetreatRight {
            0%   { transform: translateY(-50%) translateX(0); }
            100% { transform: translateY(-50%) translateX(105%); }
        }

        @keyframes bowFade {
            0%   { transform: translate(-50%, -50%) scale(1); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(.75); opacity: 0; }
        }

        @keyframes paperPop {
            0%   { transform: scale(.35) translateY(12px); opacity: 0; }
            65%  { transform: scale(1.045) translateY(-3px); opacity: 1; }
            100% { transform: scale(1) translateY(0); opacity: 1; }
        }

        @keyframes paperContentFade {
            0%   { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .message-button.is-opening .ribbon-v-top {
            animation: ribbonRetreatUp 1.4s ease-in-out forwards;
        }

        .message-button.is-opening .ribbon-v-bottom {
            animation: ribbonRetreatDown 1.4s ease-in-out forwards;
        }

        .message-button.is-opening .ribbon-h-left {
            animation: ribbonRetreatLeft 1.4s ease-in-out forwards;
        }

        .message-button.is-opening .ribbon-h-right {
            animation: ribbonRetreatRight 1.4s ease-in-out forwards;
        }

        .message-button.is-opening .ribbon-bow {
            animation: bowFade .5s ease-in forwards;
            animation-delay: .15s;
        }

        .message-button.is-opening .white-paper {
            animation: paperPop .75s cubic-bezier(.22,1,.36,1) forwards;
            animation-delay: 1.2s;
        }

        .message-button.is-opening .paper-content {
            animation: paperContentFade .55s ease forwards;
            animation-delay: 1.65s;
        }

        .message-button.is-opening .message-badge,
        .message-button.is-opening .message-instruction {
            opacity: 0;
            transition: opacity .3s ease;
        }

        @media (max-width: 639px) {
            .letter-scene {
                width: min(86vw, 300px);
                height: min(64dvh, 390px);
            }

            .white-paper {
                inset: 12px;
                padding: 18px 16px;
            }

            .ribbon-v-top,
            .ribbon-v-bottom {
                width: 24px;
            }

            .ribbon-h-left,
            .ribbon-h-right {
                height: 24px;
            }

            .ribbon-bow {
                width: 52px;
                height: 34px;
            }

            .bow-wing {
                width: 24px;
                height: 24px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body class="min-h-[100dvh] overflow-x-hidden bg-[#080506] text-white">

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
    <main class="relative flex min-h-[100dvh] items-center justify-center px-4 py-6 sm:px-6">

        <!-- Initial Screen -->
        <section
            id="giftScreen"
            class="flex flex-col items-center text-center transition-all duration-700"
        >

            <p class="mb-3 text-xs font-medium uppercase tracking-[0.45em] text-rose-300/70">
                A little something for you
            </p>

            <h1 class="text-3xl font-semibold tracking-tight sm:text-6xl">
                For <span class="text-rose-400">Gisel</span>
            </h1>

            <p class="mt-4 max-w-md px-3 text-sm leading-6 text-white/50 sm:px-0 sm:text-base sm:leading-7">
                Ada sesuatu kecil yang aku siapin buat kamu.
                Coba buka hadiahnya.
            </p>


            <!-- GIFT -->
            <button
                id="giftButton"
                aria-label="Buka hadiah untuk Gisel"
                type="button"
                class="group relative mt-10 h-44 w-44 touch-manipulation outline-none sm:mt-12 sm:h-56 sm:w-56"
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


        <!-- MESSAGE BUTTON / SURAT -->
        <section
            id="messageSection"
            class="pointer-events-none absolute inset-0
                   flex items-center justify-center
                   opacity-0
                   transition-all duration-1000"
        >
            <div class="flex flex-col items-center text-center">

                <div
                    class="mb-5 rounded-full
                           border border-white/10
                           bg-white/[0.04]
                           px-4 py-2 text-[10px]
                           uppercase tracking-[0.35em]
                           text-rose-300/70 backdrop-blur-xl"
                >
                    Just for you
                </div>

                <h2 class="text-2xl font-semibold sm:text-5xl">
                    Ada pesan buat kamu
                </h2>

                <p class="mt-3 max-w-sm text-sm leading-6 text-white/40">
                    Aku sengaja bikin ini khusus buat kamu.
                </p>

                <!-- SURAT KRIM + PITA MERAH -> TEKS SURAT MUNCUL DI DALAM AMPLOP -->
                <button
                    id="messageButton"
                    type="button"
                    aria-label="Buka surat untuk Gisel"
                    class="message-button group relative mt-8 flex touch-manipulation flex-col items-center outline-none"
                >
                    <div class="letter-scene">

                        <!-- Glow di belakang surat -->
                        <div class="absolute -inset-8 -z-10 rounded-[2.5rem] bg-rose-500/20 blur-3xl
                                    transition-all duration-500 group-hover:bg-rose-500/35"></div>

                        <div class="cream-letter">
                            <!-- Badan surat warna krim -->
                            <div class="cream-letter-body"></div>

                            <!-- Kertas isi surat: muncul DI DALAM amplop setelah pita dibuka -->
                            <div class="white-paper">
                                <div class="paper-content">
                                    <span class="paper-label">For Raden Ayu Giselle</span>
                                    <span class="paper-title">Untuk kamu ❤️</span>

                                    <div class="paper-body">
                                        <p>Hai Sayangg.</p>
                                        <p>Mungkin ini cuma sebuah website kecil, tapi aku bikin ini dengan niat yang besar.</p>
                                        <p>Aku cuma mau bilang kalau aku bersyukur bisa kenal dan punya kamu di hidupku.</p>
                                        <p>Semoga sesederhana apa pun hal yang aku kasih, kamu tetap bisa ngerasain kalau ini dibuat khusus untuk kamu.</p>
                                        <p class="paper-strong">Terima kasih sudah menjadi seseorang yang begitu berarti buat aku.</p>
                                    </div>

                                    <div class="paper-signoff">
                                        <span class="signoff-label">With all my heart,</span>
                                        <span class="signoff-name">Jova Liandri</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pita merah yang menutupi surat -->
                            <div class="ribbon-vertical">
                                <div class="ribbon-v-top"></div>
                                <div class="ribbon-v-bottom"></div>
                            </div>
                            <div class="ribbon-horizontal">
                                <div class="ribbon-h-left"></div>
                                <div class="ribbon-h-right"></div>
                            </div>
                            <div class="ribbon-bow">
                                <span class="bow-wing bow-wing-left"></span>
                                <span class="bow-wing bow-wing-right"></span>
                                <span class="bow-knot"></span>
                            </div>
                        </div>

                        <!-- Notification -->
                        <span
                            class="message-badge absolute -right-2 -top-2 z-20 flex h-7 w-7
                                   animate-bounce items-center justify-center rounded-full
                                   border-2 border-[#080506] bg-red-500 text-[11px]
                                   font-bold text-white shadow-lg"
                        >
                            1
                        </span>
                    </div>

                    <span
                        class="message-instruction mt-4 whitespace-nowrap
                               text-[10px] tracking-widest text-white/40
                               transition-all duration-300
                               group-hover:text-rose-300"
                    >
                        KLIK UNTUK MEMBACA
                    </span>
                </button>
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
            const roseCount = window.innerWidth < 640 ? 45 : 110;

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
         * Tombol buka surat: pita terbuka lalu kertas isi surat
         * langsung muncul DI DALAM amplop (bukan di luar / popup lain)
         */
        let messageOpened = false;

        messageButton.addEventListener('click', () => {

            if (messageOpened) return;
            messageOpened = true;

            messageButton.classList.add('is-opening');

        });

    </script>

</body>

</html>