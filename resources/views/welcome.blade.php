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

        @media (max-width: 639px) {
            .message-card-mobile {
                max-height: calc(100dvh - 24px);
                overflow-y: auto;
            }
        }


        /* ==============================
           ENVELOPE -> CREAM LETTER ANIMATION
           ============================== */
        .letter-scene {
            position: relative;
            width: min(82vw, 320px);
            height: 190px;
            perspective: 900px;
        }

        .envelope-wrap {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 220px;
            height: 145px;
            transform: translate(-50%, -50%);
            transform-style: preserve-3d;
            transition: transform .45s ease;
        }

        .envelope-body {
            position: absolute;
            inset: 0;
            overflow: hidden;
            border-radius: 16px;
            background: linear-gradient(145deg, #e52a55, #b30e35 70%, #7f1028);
            border: 1px solid rgba(255,255,255,.22);
            box-shadow: 0 24px 60px rgba(190,24,93,.42);
            z-index: 3;
        }

        .envelope-paper {
            position: absolute;
            left: 10%;
            bottom: 5px;
            width: 80%;
            height: 126px;
            padding: 17px 15px;
            border-radius: 5px 5px 10px 10px;
            background: linear-gradient(135deg, #fff8e8, #f4e4c4);
            color: #5d4435;
            box-shadow: 0 12px 25px rgba(0,0,0,.22);
            z-index: 2;
            transform: translateY(82px);
            transition:
                transform 1s cubic-bezier(.16,1,.3,1),
                box-shadow 1s ease;
        }

        .envelope-paper::before {
            content: "";
            position: absolute;
            inset: 7px;
            border: 1px solid rgba(139,91,50,.16);
            border-radius: 3px;
        }

        .paper-content {
            position: relative;
            z-index: 1;
            text-align: center;
            font-family: Georgia, serif;
            opacity: 0;
            transform: translateY(8px);
            transition: opacity .5s ease .45s, transform .5s ease .45s;
        }

        .paper-heart {
            display: block;
            margin-bottom: 4px;
            font-size: 22px;
        }

        .paper-title {
            display: block;
            font-size: 14px;
            font-weight: 700;
        }

        .paper-subtitle {
            display: block;
            margin-top: 3px;
            font-size: 9px;
            letter-spacing: .18em;
            text-transform: uppercase;
            opacity: .58;
        }

        .envelope-flap {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 78%;
            background: linear-gradient(145deg, #ee4265, #bd153d);
            clip-path: polygon(0 0, 100% 0, 50% 72%);
            transform-origin: top center;
            transform: rotateX(0deg);
            transition: transform .7s cubic-bezier(.16,1,.3,1);
            z-index: 5;
            backface-visibility: hidden;
            filter: drop-shadow(0 4px 8px rgba(0,0,0,.12));
        }

        .envelope-front-fold {
            position: absolute;
            inset: 0;
            z-index: 4;
            pointer-events: none;
            background:
                linear-gradient(32deg, transparent 49%, rgba(255,255,255,.15) 50%, transparent 51%),
                linear-gradient(-32deg, transparent 49%, rgba(255,255,255,.10) 50%, transparent 51%);
        }

        .envelope-icon {
            position: absolute;
            left: 50%;
            top: 52%;
            z-index: 6;
            width: 52px;
            height: 52px;
            transform: translate(-50%, -50%);
            transition: opacity .25s ease, transform .4s ease;
        }

        .message-button.is-opening .envelope-wrap {
            transform: translate(-50%, -50%) translateY(8px) scale(.96);
        }

        .message-button.is-opening .envelope-flap {
            transform: rotateX(180deg);
        }

        .message-button.is-opening .envelope-paper {
            transform: translateY(-78px);
            box-shadow: 0 20px 35px rgba(0,0,0,.28);
        }

        .message-button.is-opening .paper-content {
            opacity: 1;
            transform: translateY(0);
        }

        .message-button.is-opening .envelope-icon,
        .message-button.is-opening .message-badge {
            opacity: 0;
        }

        .message-button.is-opening .message-instruction {
            opacity: 0;
        }

        .message-button.is-opened .envelope-wrap {
            opacity: 0;
            transform: translate(-50%, -50%) translateY(-22px) scale(1.08);
            transition: opacity .45s ease, transform .55s ease;
        }

        @media (max-width: 639px) {
            .letter-scene {
                width: 290px;
                height: 175px;
            }

            .envelope-wrap {
                width: 205px;
                height: 135px;
            }

            .envelope-paper {
                height: 116px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
            .envelope-flap,
            .envelope-paper,
            .paper-content,
            .envelope-wrap,
            .envelope-icon {
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

                <!-- ENVELOPE + CREAM LETTER ANIMATION -->
                <button
                    id="messageButton"
                    type="button"
                    aria-label="Buka surat untuk Gisel"
                    class="message-button group relative mt-8 flex h-[210px] w-[300px]
                           touch-manipulation items-center justify-center outline-none
                           sm:mt-10 sm:h-[230px] sm:w-[330px]"
                >
                    <div class="absolute inset-12 rounded-full bg-rose-500/20 blur-3xl
                                transition-all duration-500 group-hover:bg-rose-500/35"></div>

                    <div class="letter-scene">
                        <!-- Cream paper is behind the envelope and rises when opened -->
                        <div class="envelope-paper">
                            <div class="paper-content">
                                <span class="paper-heart">♥</span>
                                <span class="paper-title">Untuk kamu</span>
                                <span class="paper-subtitle">a little letter</span>
                            </div>
                        </div>

                        <div class="envelope-wrap">
                            <div class="envelope-body"></div>

                            <!-- Envelope flap -->
                            <div class="envelope-flap"></div>

                            <!-- Front folds -->
                            <div class="envelope-front-fold"></div>

                            <!-- Letter icon -->
                            <svg
                                class="envelope-icon"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.5"
                                aria-hidden="true"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916v-.243" />
                            </svg>
                        </div>
                    </div>

                    <!-- Notification -->
                    <span
                        class="message-badge absolute right-3 top-1 z-20 flex h-7 w-7
                               animate-bounce items-center justify-center rounded-full
                               border-2 border-[#080506] bg-red-500 text-[11px]
                               font-bold text-white shadow-lg sm:right-5"
                    >
                        1
                    </span>

                    <span
                        class="message-instruction absolute bottom-1 whitespace-nowrap
                               text-[10px] tracking-widest text-white/40
                               transition-all duration-300
                               group-hover:text-rose-300"
                    >
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
                class="message-card-mobile relative w-full max-w-lg
                       translate-y-10
                       scale-95
                       rounded-[2rem]
                       border border-white/10
                       bg-white/[0.055]
                       p-5 sm:p-7
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


                <div class="space-y-4 text-[13px] leading-6 sm:text-sm sm:leading-7
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
         * Tombol buka pesan (DIPERBAIKI DI SINI)
         */
        let messageOpened = false;

        messageButton.addEventListener('click', () => {

            if (messageOpened) return;
            messageOpened = true;

            // 1. Buka flap amplop
            messageButton.classList.add('is-opening');

            // 2. Biarkan kertas cream naik keluar seperti hadiah dibuka
            setTimeout(() => {
                messageButton.classList.add('is-opened');
            }, 1350);

            // 3. Setelah surat muncul, tampilkan isi pesan
            setTimeout(() => {
                messageSection.style.opacity = '0';
                messageSection.style.pointerEvents = 'none';

                messageCard.style.opacity = '1';
                messageCard.style.pointerEvents = 'auto';

                setTimeout(() => {
                    messageCardInner.style.transform =
                        'translateY(0) scale(1)';
                }, 50);
            }, 1600);

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