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
           AMBIENT MOTION: idle animasi supaya halaman terasa hidup,
           bukan statis, di setiap bagian (bukan cuma saat diklik)
           ================================================== */
        @keyframes floatY {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes glowPulse {
            0%, 100% { opacity: .55; transform: scale(1); }
            50% { opacity: .9; transform: scale(1.1); }
        }

        @keyframes hintNudge {
            0%, 100% { transform: translateY(0); opacity: .45; }
            50% { transform: translateY(-3px); opacity: .85; }
        }

        /* Sama seperti hintNudge, tapi buat elemen yang posisinya
           di-tengah-kan pakai translateX(-50%) — supaya animasinya
           tidak "menimpa" dan menghapus posisi tengah tersebut */
        @keyframes hintNudgeCentered {
            0%, 100% { transform: translateX(-50%) translateY(0); opacity: .45; }
            50% { transform: translateX(-50%) translateY(-3px); opacity: .85; }
        }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(18px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes blobDrift {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(24px, -18px) scale(1.1); }
        }

        /* blob tengah dipusatkan lewat -translate-x/y-1/2 di HTML-nya,
           jadi keyframe-nya perlu ikut membawa itu supaya tidak "meloncat" */
        @keyframes blobDriftCenter {
            0%, 100% { transform: translate(-50%, -50%) translate(0, 0) scale(1); }
            50% { transform: translate(-50%, -50%) translate(24px, -18px) scale(1.1); }
        }

        @keyframes blobDriftReverse {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(-20px, 16px) scale(1.08); }
        }

        @keyframes gridDrift {
            0% { background-position: 0 0; }
            100% { background-position: 50px 50px; }
        }

        .bg-blob-1 { animation: blobDriftCenter 11s ease-in-out infinite; }
        .bg-blob-2 { animation: blobDriftReverse 13s ease-in-out infinite; }
        .bg-blob-3 { animation: blobDrift 15s ease-in-out infinite; animation-delay: -4s; }
        .bg-grid { animation: gridDrift 6s linear infinite; }

        .entrance-fade {
            opacity: 0;
            animation: fadeInUp .9s ease forwards;
        }

        .gift-glow {
            animation: glowPulse 3.4s ease-in-out infinite;
        }

        #giftButton {
            animation: floatY 4.2s ease-in-out infinite;
        }

        #giftButton.is-opening {
            animation-play-state: paused;
        }

        .hint-pulse {
            animation: hintNudge 2.4s ease-in-out infinite;
        }

        .hint-pulse-centered {
            animation: hintNudgeCentered 2.4s ease-in-out infinite;
        }

        #messageButton {
            animation: floatY 4.6s ease-in-out infinite;
            animation-delay: -1.5s;
        }

        #messageButton.is-opening {
            animation-play-state: paused;
        }

        .msg-child {
            opacity: 0;
        }

        #messageSection.is-visible .msg-child {
            animation: fadeInUp .8s ease forwards;
        }

        /* ==================================================
           SURAT: AMPLOP KRIM + PITA MERAH -> KERTAS DI DALAM AMPLOP
           (teks surat sekarang tampil DI DALAM amplop, lalu naik
           keluar dan menyembul di atas amplop seperti video referensi)
           ================================================== */
        .letter-scene {
            position: relative;
            width: min(85vw, 300px);
            height: min(45vh, 190px);
        }

        .cream-letter {
            position: absolute;
            inset: 0;
            border-radius: 14px;
            perspective: 900px;
        }

        .cream-letter-body {
            position: absolute;
            inset: 0;
            z-index: 1;
            overflow: hidden;
            border-radius: 14px;
            background: linear-gradient(150deg, #fff8e8, #f2dfb8 55%, #e9cf9e);
            border: 1px solid rgba(139, 91, 50, .3);
            box-shadow: 0 20px 50px rgba(0,0,0,.35);
        }

        .cream-letter-body::before {
            content: "";
            position: absolute;
            inset: 8px;
            border: 1px solid rgba(139,91,50,.18);
            border-radius: 9px;
        }

        /* Wadah kliping untuk kertas surat: dibatasi HANYA di bagian bawah
           (sejajar dasar amplop) supaya kertas tetap tersembunyi saat masih
           di dalam amplop, tapi TIDAK terpotong saat naik dan menyembul
           di atas amplop — persis seperti video referensi. clip-path boleh
           punya nilai di luar 0-100% sehingga area atas dibiarkan longgar.
           Elemen ini sengaja diletakkan DI DALAM .cream-letter (bukan di
           luar) supaya urutan tumpuk (z-index) kertas tetap satu grup
           dengan badan amplop, bagian depan amplop, flap, dan pita —
           sehingga kertas benar-benar keselip di tengah, bukan malah
           tampil paling depan menutupi seluruh amplop. */
        .paper-clip {
            position: absolute;
            inset: 0;
            z-index: 2;
            pointer-events: none;
            clip-path: polygon(-25% -280%, 125% -280%, 125% 100%, -25% 100%);
        }

        /* Bagian DEPAN amplop: lapisan ini menutupi kertas surat sepenuhnya
           (sama seperti badan belakang amplop), diletakkan DI ATAS kertas
           tapi DI BAWAH flap+pita. Efeknya: kertas jadi "terselip" di
           tengah, di antara belakang dan depan amplop — hanya kelihatan
           saat sudah naik melewati bibir atas amplop (lubang bekas flap),
           persis seperti video referensi. */
        .envelope-front {
            position: absolute;
            inset: 0;
            z-index: 3;
            border-radius: 14px;
            background: linear-gradient(150deg, #fff8e8, #f2dfb8 55%, #e9cf9e);
            border: 1px solid rgba(139, 91, 50, .3);
        }

        .envelope-front::before {
            content: "";
            position: absolute;
            inset: 8px;
            border: 1px solid rgba(139,91,50,.18);
            border-radius: 9px;
        }

        /* Flap segitiga di bagian atas amplop, menutupi lubang amplop.
           Terbuka (terlipat ke belakang) sesudah pita lepas, sebelum
           suratnya ditarik keluar. Rasio flap dibikin lebih pipih supaya
           proporsinya seperti amplop biasa (bukan amplop tinggi). */
        .envelope-flap {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 52%;
            z-index: 4;
            clip-path: polygon(0 0, 100% 0, 50% 96%);
            /* Sama arah & palet warna dengan body amplop (150deg, krim ke
               tan), cuma sedikit lebih gelap di bagian bawah -- jadi beda
               keliatan tapi tetap nyatu rapi, bukan kayak dua potongan
               warna yang beda sendiri (itu penyebab kelihatan patah). */
            background: linear-gradient(150deg, #fdf3dd, #ecd7ab 55%, #ddbe84);
            box-shadow: 0 8px 16px rgba(0,0,0,.15);
            transform-origin: top center;
            backface-visibility: hidden;
        }

        /* Garis lipatan tipis di tepi bawah flap supaya batas flap dan
           body tetap kebaca, tanpa bikin kontrasnya kasar */
        .envelope-flap::after {
            content: "";
            position: absolute;
            inset: 0;
            clip-path: polygon(0 0, 100% 0, 50% 96%);
            box-shadow: inset 0 -1px 0 rgba(139, 91, 50, .35);
            pointer-events: none;
        }

        /* Kertas isi surat: mulai tersembunyi DI BAWAH amplop (di luar area
           yang tidak ter-clip) sampai pita+flap terbuka, lalu meluncur naik
           dan berhenti menyembul di ATAS amplop (bukan cuma mengisi penuh
           di dalam amplop) */
        .white-paper {
            position: absolute;
            inset: 12px;
            overflow-y: auto;
            border-radius: 10px;
            background: #fffdf8;
            box-shadow: 0 10px 30px rgba(0,0,0,.18);
            padding: 18px 16px;
            pointer-events: auto;
            transform: translateY(118%) scale(.88);
            transform-origin: bottom center;
            z-index: 2;
        }

        .paper-content {
            text-align: left;
            font-family: Georgia, serif;
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
            font-size: 17px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #4a3527;
        }

        .paper-body p {
            font-size: 12px;
            line-height: 1.65;
            margin-bottom: 9px;
            color: #6b5340;
        }

        .paper-body p.paper-strong {
            color: #4a3527;
        }

        .paper-signoff {
            margin-top: 12px;
            padding-top: 10px;
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

        /* Wadah khusus buat pita: DIBATASI (overflow hidden) mengikuti
           bentuk membulat amplop, supaya saat pita mundur/lepas dia
           benar-benar "tenggelam" rapi ke bawah bibir amplop dan tidak
           meluber keluar dari sudut amplop yang membulat (itu penyebab
           animasi pita kelihatan aneh/patah sebelumnya). */
        .ribbon-clip {
            position: absolute;
            inset: 0;
            z-index: 5;
            border-radius: 14px;
            overflow: hidden;
            pointer-events: none;
        }

        /* Pita merah yang menutupi surat sebelum dibuka */
        .ribbon-vertical,
        .ribbon-horizontal {
            position: absolute;
            inset: 0;
        }

        .ribbon-v-top,
        .ribbon-v-bottom {
            position: absolute;
            left: 50%;
            width: 22px;
            height: 50%;
            transform: translateX(-50%);
            background: linear-gradient(180deg, #f0537a, #b30e35);
            box-shadow: 0 2px 10px rgba(0,0,0,.25);
        }

        .ribbon-v-top {
            top: 0;
        }

        .ribbon-v-bottom {
            bottom: 0;
        }

        .ribbon-h-left,
        .ribbon-h-right {
            position: absolute;
            top: 50%;
            height: 22px;
            width: 50%;
            transform: translateY(-50%);
            background: linear-gradient(90deg, #f0537a, #b30e35);
            box-shadow: 0 2px 10px rgba(0,0,0,.25);
        }

        .ribbon-h-left {
            left: 0;
        }

        .ribbon-h-right {
            right: 0;
        }

        .ribbon-bow {
            position: absolute;
            left: 50%;
            top: 50%;
            z-index: 6;
            width: 52px;
            height: 34px;
            transform: translate(-50%, -50%);
        }

        .bow-wing {
            position: absolute;
            top: 0;
            width: 24px;
            height: 24px;
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
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: #e52a55;
            transform: translate(-50%, -50%);
            box-shadow: 0 2px 6px rgba(0,0,0,.3);
        }

        /* ---------- Animasi buka pita: mundur pelan-pelan lalu tenggelam
           habis di balik tepi amplop (dibatasi oleh .ribbon-clip di atas,
           jadi tidak lagi meluber keluar dari sudut amplop) ---------- */
        @keyframes ribbonRetreatUp {
            0%   { transform: translate(-50%, 0); opacity: 1; }
            100% { transform: translate(-50%, -100%); opacity: 1; }
        }

        @keyframes ribbonRetreatDown {
            0%   { transform: translate(-50%, 0); opacity: 1; }
            100% { transform: translate(-50%, 100%); opacity: 1; }
        }

        @keyframes ribbonRetreatLeft {
            0%   { transform: translateY(-50%) translateX(0); opacity: 1; }
            100% { transform: translateY(-50%) translateX(-100%); opacity: 1; }
        }

        @keyframes ribbonRetreatRight {
            0%   { transform: translateY(-50%) translateX(0); opacity: 1; }
            100% { transform: translateY(-50%) translateX(100%); opacity: 1; }
        }

        @keyframes bowFade {
            0%   { transform: translate(-50%, -50%) scale(1); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(.75); opacity: 0; }
        }

        /* Flap amplop terlipat ke belakang (seperti amplop asli dibuka) */
        @keyframes flapOpen {
            0%   { transform: rotateX(0deg); }
            100% { transform: rotateX(-120deg); }
        }

        /* Kertas surat ditarik naik dari dalam amplop, melewati bibir
           amplop, lalu berpindah dan berhenti di DEPAN amplop (z-index
           dinaikkan lewat class is-in-front, ditambahkan lewat JS tepat
           saat animasi ini mulai) supaya kertas benar-benar tampak
           "keluar dari dalam" lalu "ada di depan" amplop, bukan cuma
           menyembul separuh selamanya. */
        @keyframes paperSlideUp {
            0%   { transform: translateY(118%) scale(.88) rotate(0deg); }
            55%  { transform: translateY(0%) scale(1.02) rotate(-1deg); }
            80%  { transform: translateY(-38%) scale(1) rotate(-2.5deg); }
            100% { transform: translateY(-34%) scale(1) rotate(-2deg); }
        }

        .message-button.is-opening .ribbon-v-top {
            animation: ribbonRetreatUp 1.1s ease-in-out forwards;
        }

        .message-button.is-opening .ribbon-v-bottom {
            animation: ribbonRetreatDown 1.1s ease-in-out forwards;
        }

        .message-button.is-opening .ribbon-h-left {
            animation: ribbonRetreatLeft 1.1s ease-in-out forwards;
        }

        .message-button.is-opening .ribbon-h-right {
            animation: ribbonRetreatRight 1.1s ease-in-out forwards;
        }

        .message-button.is-opening .ribbon-bow {
            animation: bowFade .5s ease-in forwards;
            animation-delay: .15s;
        }

        .message-button.is-opening .envelope-flap {
            animation: flapOpen .85s ease-in forwards;
            animation-delay: .75s;
        }

        .message-button.is-opening .white-paper {
            animation: paperSlideUp 1.3s cubic-bezier(.22,1,.36,1) forwards;
            animation-delay: 1.4s;
        }

        /* Begitu suratnya mulai naik, pindahkan ke depan (di atas amplop
           depan, flap, dan pita) supaya benar-benar terlihat "di depan
           amplop", bukan cuma menyembul di lubang atas amplop. */
        .message-button.is-opening .white-paper {
            z-index: 10;
        }

        .message-button.is-opening .message-badge,
        .message-button.is-opening .message-instruction {
            opacity: 0;
            animation: none;
            transition: opacity .3s ease;
        }

        /* ==================================================
           TAHAP 2: surat yang sudah menyembul separuh (hasil animasi
           di atas) dipencet SEKALI LAGI -> muncul kartu surat TERPISAH
           di tengah layar (bukan lagi memperbesar kertas kecil di
           dalam amplop -- itu penyebab tampilannya rusak/kepotong
           sebelumnya). Kartu ini posisinya "fixed" ke layar, jadi
           benar-benar berada di DEPAN amplop dan seluruh halaman.
           ================================================== */
        #letterModal {
            position: fixed;
            inset: 0;
            z-index: 999;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        #letterModal.is-visible {
            display: flex;
        }

        #letterBackdrop {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, .78);
            opacity: 0;
            transition: opacity .4s ease;
        }

        #letterModal.is-visible #letterBackdrop {
            opacity: 1;
        }

        #letterCard {
            position: relative;
            width: min(92vw, 380px);
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 16px;
            background: #fffdf8;
            box-shadow: 0 30px 80px rgba(0, 0, 0, .5);
            padding: 30px 24px 26px;
            text-align: left;
            font-family: Georgia, serif;
            opacity: 0;
            transform: scale(.86) translateY(14px);
            transition: opacity .4s ease, transform .4s cubic-bezier(.22, 1, .36, 1);
        }

        #letterModal.is-visible #letterCard {
            opacity: 1;
            transform: scale(1) translateY(0);
        }

        #letterClose {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: none;
            background: rgba(139, 91, 50, .12);
            color: #6b5340;
            font-size: 14px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        @media (max-width: 639px) {
            .letter-scene {
                width: min(88vw, 280px);
                height: min(40vh, 170px);
            }

            .white-paper {
                inset: 10px;
                padding: 14px 12px;
            }

            .ribbon-v-top,
            .ribbon-v-bottom {
                width: 18px;
            }

            .ribbon-h-left,
            .ribbon-h-right {
                height: 18px;
            }

            .ribbon-bow {
                width: 44px;
                height: 28px;
            }

            .bow-wing {
                width: 20px;
                height: 20px;
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

        <div class="bg-blob-1 absolute left-1/2 top-1/2
                    h-[500px] w-[500px]
                    -translate-x-1/2 -translate-y-1/2
                    rounded-full
                    bg-red-900/20
                    blur-[130px]">
        </div>

        <div class="bg-blob-2 absolute -left-40 -top-40
                    h-[400px] w-[400px]
                    rounded-full
                    bg-rose-950/30
                    blur-[120px]">
        </div>

        <div class="bg-blob-3 absolute -bottom-40 -right-40
                    h-[400px] w-[400px]
                    rounded-full
                    bg-red-950/30
                    blur-[120px]">
        </div>

        <!-- subtle grid -->
        <div class="bg-grid absolute inset-0 opacity-[0.035]"
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

            <p class="entrance-fade mb-3 text-xs font-medium uppercase tracking-[0.45em] text-rose-300/70" style="animation-delay:.1s;">
                A little something for you
            </p>

            <h1 class="entrance-fade text-3xl font-semibold tracking-tight sm:text-6xl" style="animation-delay:.25s;">
                For <span class="text-rose-400">Sweetheart</span>
            </h1>

            <p class="entrance-fade mt-4 max-w-md px-3 text-sm leading-6 text-white/50 sm:px-0 sm:text-base sm:leading-7" style="animation-delay:.4s;">
                Ada sesuatu kecil yang aku siapin buat kamu.
                Coba buka hadiahnya.
            </p>


            <!-- GIFT -->
            <button
                id="giftButton"
                aria-label="Buka hadiah untuk kamu"
                type="button"
                class="group relative mt-10 h-44 w-44 touch-manipulation outline-none sm:mt-12 sm:h-56 sm:w-56"
            >

                <!-- Glow -->
                <div class="gift-glow absolute inset-4
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
                    class="hint-pulse-centered absolute -bottom-12 left-1/2
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
                    class="msg-child mb-5 rounded-full
                           border border-white/10
                           bg-white/[0.04]
                           px-4 py-2 text-[10px]
                           uppercase tracking-[0.35em]
                           text-rose-300/70 backdrop-blur-xl"
                    style="animation-delay:.15s;"
                >
                    Just for you
                </div>

                <h2 class="msg-child text-2xl font-semibold sm:text-5xl" style="animation-delay:.3s;">
                    Ada pesan buat kamu
                </h2>

                <p class="msg-child mt-3 max-w-sm text-sm leading-6 text-white/40" style="animation-delay:.45s;">
                    Aku sengaja bikin ini khusus buat kamu.
                </p>

                <!-- SURAT KRIM + PITA MERAH -> TEKS SURAT MUNCUL DI DALAM AMPLOP,
                     LALU NAIK DAN PINDAH KE DEPAN AMPLOP -->
                <button
                    id="messageButton"
                    type="button"
                    aria-label="Buka surat untuk kamu"
                    class="message-button group relative mt-8 flex touch-manipulation flex-col items-center outline-none"
                >
                    <div class="letter-scene">

                        <!-- Glow di belakang surat -->
                        <div class="absolute -inset-8 -z-10 rounded-[2.5rem] bg-rose-500/20 blur-3xl
                                    transition-all duration-500 group-hover:bg-rose-500/35"></div>

                        <div class="cream-letter">
                            <!-- Badan surat warna krim (belakang amplop) -->
                            <div class="cream-letter-body"></div>

                            <!-- Kertas isi surat: diletakkan DI DALAM urutan lapisan
                                 amplop (di atas badan belakang, di bawah bagian depan)
                                 supaya benar-benar "keselip" di tengah amplop, bukan
                                 melayang di depan semuanya -->
                            <div class="paper-clip">
                                <div class="white-paper">
                                    <div class="paper-content">
                                        <span class="paper-label">For Raden Ayu Giselle</span>
                                        <span class="paper-title">Dear Babe❤️</span>

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
                            </div>

                            <!-- Bagian DEPAN amplop: menutupi kertas surat sampai ia
                                 naik melewati bibir amplop -->
                            <div class="envelope-front"></div>

                            <!-- Flap amplop: terbuka (terlipat ke belakang) setelah pita lepas -->
                            <div class="envelope-flap"></div>

                            <!-- Pita merah yang menutupi surat, dibatasi bentuk
                                 membulat amplop supaya animasi mundurnya rapi -->
                            <div class="ribbon-clip">
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
                        class="message-instruction hint-pulse mt-4 whitespace-nowrap
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

    <!-- MODAL: kartu surat penuh, tampil TERPISAH di depan amplop & halaman
         (dipicu saat surat yang sudah menyembul separuh dipencet lagi) -->
    <div id="letterModal">
        <div id="letterBackdrop"></div>
        <div id="letterCard">
            <button id="letterClose" type="button" aria-label="Tutup surat">✕</button>

            <span class="paper-label">For Raden Ayu Giselle</span>
            <span class="paper-title">Dear Babe❤️</span>

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

            // Hentikan idle float supaya animasi buka hadiah tidak "berebut" transform
            giftButton.classList.add('is-opening');

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
             * 5. Tampilkan tombol pesan (dengan urutan muncul bertahap)
             */
            setTimeout(() => {

                messageSection.style.opacity = '1';
                messageSection.style.pointerEvents = 'auto';
                messageSection.classList.add('is-visible');

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
         * Tombol buka surat, dua tahap:
         * Tahap 1 (klik pertama): pita mundur & tenggelam di balik tepi
         * amplop, flap terbuka ke belakang, lalu kertas isi surat
         * meluncur naik dan menyembul separuh dari dalam amplop.
         * Tahap 2 (klik kedua, pas surat lagi menyembul separuh): surat
         * itu dipencet lagi, lalu dia pindah sepenuhnya dari "di dalam
         * amplop" ke "di depan amplop" (diperbesar & ditempatkan di
         * depan supaya nyaman dibaca).
         */
        let messageStage = 0; // 0 = tertutup, 1 = lagi animasi/menyembul, 1.5 = siap diklik lagi, 2 = kartu surat lagi terbuka

        // Durasi total tahap 1 sebelum surat berhenti menyembul & siap diklik lagi
        const STAGE1_DELAY_MS = 1400; // delay sebelum paperSlideUp mulai
        const STAGE1_DURATION_MS = 1300; // durasi animasi paperSlideUp
        const STAGE1_TOTAL_MS = STAGE1_DELAY_MS + STAGE1_DURATION_MS;

        const letterModal = document.getElementById('letterModal');
        const letterBackdrop = document.getElementById('letterBackdrop');
        const letterClose = document.getElementById('letterClose');

        function openLetterCard() {
            letterModal.classList.add('is-visible');
        }

        function closeLetterCard() {
            letterModal.classList.remove('is-visible');
            // biar bisa dibuka lagi kalau suratnya diklik sekali lagi
            if (messageStage === 2) {
                messageStage = 1.5;
            }
        }

        messageButton.addEventListener('click', () => {

            if (messageStage === 0) {

                messageStage = 1;
                messageButton.classList.add('is-opening');

                // Begitu surat selesai menyembul separuh, izinkan klik
                // berikutnya untuk membuka kartu suratnya di depan
                setTimeout(() => {
                    if (messageStage === 1) {
                        messageStage = 1.5; // siap diklik lagi
                    }
                }, STAGE1_TOTAL_MS);

                return;
            }

            if (messageStage === 1.5) {

                messageStage = 2;
                openLetterCard();

            }

            // Kalau masih dalam proses animasi (stage 1, belum 1.5)
            // atau kartu surat sedang terbuka (stage 2), klik amplop
            // diabaikan supaya tidak nabrak animasi/kartu yang aktif.

        });

        // Tutup kartu surat lewat tombol ✕ atau klik area gelap di luar kartu
        letterClose.addEventListener('click', closeLetterCard);
        letterBackdrop.addEventListener('click', closeLetterCard);

    </script>

</body>

</html>