<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Sans:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap&family=Italianno&display=swap" rel="stylesheet">

    <link href="<?= base_url('css/output.css') ?>" rel="stylesheet">
    <title>Asri Graha - Hotel Yogyakarta</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta name="description" content="Asri Graha Hotel menawarkan pengalaman menginap yang nyaman dan terjangkau di Jogja. Nikmati kenyamanan fasilitas kami yang lengkap dengan harga yang terjangkau dan lokasi yang strategis di tengah kota Jogja. Pesan sekarang dan temukan pengalaman menginap yang tak terlupakan!">
    <meta name="keywords" content="hotel, Jogja, murah, terjangkau, lokasi strategis, penginapan, akomodasi, wisata, liburan, pengalaman menginap">
    <meta name="robots" content="index, follow"> <!-- Untuk mengizinkan indeks dan mengikuti tautan -->
    <meta name="author" content="Asri Graha">
</head>

<body>
    <nav data-aos="fade-down" data-aos-duration="600" class="bg-transparent text-white border-gray-200 dark:bg-gray-900 absolute w-full z-10">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" /> -->
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Asri Graha Hotel</span>
            </a>
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-white rounded-lg md:hidden hover:bg-yellow-300 focus:outline-none focus:ring-2 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-white md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:text-white md:dark:hover:bg-transparent">About</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:text-white md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:text-white md:dark:hover:bg-transparent">Pricing</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:text-white md:dark:hover:bg-transparent">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <section class="relative bg-center bg-cover bg-no-repeat bg-[url('/img/bg-asri.png')]">
        <div class="absolute inset-0 bg-black opacity-60"></div>
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-64">
            <h1 data-aos="fade-right" data-aos-duration="800" class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-8xl">ASRI GRAHA</h1>
            <p data-aos="fade-left" data-aos-duration="1000" class="mb-8 text-4xl font-script text-gray-300 lg:text-8xl sm:px-16 lg:px-48">Hotel Yogyakarta</p>
            <div data-aos="zoom-in" data-aos-duration="1200" class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-yellow-400 hover:bg-yellow-300 focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900">
                    Reservasi Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- <div class="flex items-center justify-center relative py-12 md:py-0">
    <form class="bg-white py-3 px-4 border rounded relative md:absolute flex flex-col md:flex-row gap-3">
        <input type="text" id="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama" required />
    <div date-rangepicker datepicker-autohide class="flex items-center gap-3">
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
               <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
              </svg>
          </div>
          <input name="start" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Check In">
        </div>
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
               <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
              </svg>
          </div>
          <input name="end" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Check Out">
        </div>
      </div>
      <input type="number" id="visitors" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required onfocus="this.placeholder = ''" onblur="this.placeholder = 'Jumlah Tamu'" placeholder="Jumlah Tamu"/>
      <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reservasi</button>
    </form>
</div> -->

    <section>
        <div data-aos="zoom-in-up" class="px-4 mx-auto max-w-screen-xl text-center py-12 lg:py-24">
            <h2 class="mb-4 text-xl font-extrabold tracking-tight leading-none md:text-2xl lg:text-3xl">ASRI GRAHA</h2>
            <p class="mb-8 font-normal">Selamat datang di tempat di mana kenyamanan bertemu dengan nilai terbaik dengan harga yang terjangkau. Di Hotel Asri Graha, kami tidak hanya menawarkan tempat istirahat yang nyaman, tetapi juga pengalaman tak terlupakan di tengah hiruk-pikuk kota Jogja yang dinamis. Dengan harga yang ramah di kantong, Anda dapat menikmati segala keunggulan fasilitas dan layanan kami tanpa perlu khawatir menguras anggaran.</p>
            <div class="grid md:grid-cols-3 gap-4">
                <div data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="600">
                    <img class="h-64 object-cover w-full rounded-lg" src="/img/room-new3.png" alt="">
                </div>
                <div data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="800">
                    <img class="h-64 object-cover w-full rounded-lg" src="/img/room-new2.png" alt="">
                </div>
                <div data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine" data-aos-duration="1000">
                    <img class="h-64 object-cover w-full rounded-lg" src="/img/room-new1.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="px-4 mx-auto max-w-screen-xl py-12">
            <h2 class="text-center mb-12 text-2xl font-extrabold tracking-tight leading-none md:text-2xl lg:text-3xl">Mengapa Memilih Kami?</h2>
            <div class="grid lg:grid-cols-3 gap-4">


                <div data-aos="fade-up" data-aos-offset="300" data-aos-duration="600" class="flex flex-col gap-1 py-8 px-8 bg-gray-100 border-neutral-200 rounded dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-4 mb-3 bg-yellow-300 rounded-xl self-start items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M12.0009 13.4299C13.724 13.4299 15.1209 12.0331 15.1209 10.3099C15.1209 8.58681 13.724 7.18994 12.0009 7.18994C10.2777 7.18994 8.88086 8.58681 8.88086 10.3099C8.88086 12.0331 10.2777 13.4299 12.0009 13.4299Z" stroke="#292D32" stroke-width="1.5" />
                            <path d="M3.61971 8.49C5.58971 -0.169998 18.4197 -0.159997 20.3797 8.5C21.5297 13.58 18.3697 17.88 15.5997 20.54C13.5897 22.48 10.4097 22.48 8.38971 20.54C5.62971 17.88 2.46971 13.57 3.61971 8.49Z" stroke="#292D32" stroke-width="1.5" />
                        </svg>
                    </div>

                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Lokasi Strategis</h5>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Terletak di pusat kota Jogja, kami menyediakan akses yang mudah ke semua destinasi wisata terkenal dan titik-titik penting lainnya.</p>
                </div>
                <div data-aos="fade-up" data-aos-offset="300" data-aos-duration="800" class="flex flex-col gap-1 py-8 px-8 bg-gray-100 border-neutral-200 rounded dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-4 mb-3 bg-yellow-300 rounded-xl self-start items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.4">
                                <path d="M8.67188 14.3298C8.67188 15.6198 9.66188 16.6598 10.8919 16.6598H13.4019C14.4719 16.6598 15.3419 15.7498 15.3419 14.6298C15.3419 13.4098 14.8119 12.9798 14.0219 12.6998L9.99187 11.2998C9.20187 11.0198 8.67188 10.5898 8.67188 9.36984C8.67188 8.24984 9.54187 7.33984 10.6119 7.33984H13.1219C14.3519 7.33984 15.3419 8.37984 15.3419 9.66984" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 6V18" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                    </div>
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Harga Terjangkau</h5>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Dengan harga yang terjangkau, kami memastikan setiap tamu kami mendapatkan pengalaman menginap yang memuaskan tanpa harus menguras kantong.</p>
                </div>
                <div data-aos="fade-up" data-aos-offset="300" data-aos-duration="1000" class="flex flex-col gap-1 py-8 px-8 bg-gray-100 border-neutral-200 rounded dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-4 mb-3 bg-yellow-300 rounded-xl self-start items-center">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M4.91016 11.8401C9.21016 8.5201 14.8002 8.5201 19.1002 11.8401" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M2 8.3601C8.06 3.6801 15.94 3.6801 22 8.3601" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M6.78906 15.4902C9.93906 13.0502 14.0491 13.0502 17.1991 15.4902" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path opacity="0.4" d="M9.40039 19.1499C10.9804 17.9299 13.0304 17.9299 14.6104 19.1499" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                    </div>
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Fasilitas Memadai</h5>
                    <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">Hotel Asri Graha menawarkan kenyamanan tanpa mengorbankan kualitas. Nikmati fasilitas seperti AC, Smart TV, Parkir, Resepsionis 24 jam, dan Wi-Fi.</p>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="px-4 mx-auto max-w-screen-xl py-12 lg:py-24 grid gap-3 lg:grid-cols-2">
            <div data-aos="fade-right" data-aos-offset="300" data-aos-duration="600">
                <h2 class="mb-12 text-2xl font-extrabold tracking-tight leading-none md:text-2xl lg:text-3xl">Tempat Terdekat</h2>
                <span class="font-bold">Landmarks:</span>
                <ul class="list-disc ps-6">
                    <li>De Mata Trick Eye 3D Museum – 2 min walk</li>
                    <li>Faculty of Industrial Technology – 14 min walk</li>
                    <li>Lapangan Karang Kotagede – 23 min walk</li>
                    <li>Gembira Loka Zoo – 26 min walk</li>
                    <li>Sasana Among Rogo – 29 min walk</li>
                    <li>Museum Sasmitaloka Panglima Besar Jenderal Sudirman – 30 min walk</li>
                    <li>Legi Kotagede Market – 33 min walk</li>
                    <li>Batik Plentong – 34 min walk</li>
                    <li>Pakualaman Palace – 35 min walk</li>
                    <li>Tombs Of The Kings Of Mataram Kotagede – 35 min walk</li>
                    <li>Malioboro Street – 2.5 mi / 4 km</li>
                </ul>
            </div>
            <div data-aos="fade-left" data-aos-offset="300" data-aos-duration="600" class="max-w-full">
                <iframe class="w-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.7600425130313!2d110.38568507596962!3d-7.815205677606227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5772ce70165b%3A0xf98b6df82767aed9!2sHotel%20Asri%20Graha!5e0!3m2!1sid!2sid!4v1713337761744!5m2!1sid!2sid" width="auto" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>


    <footer class="bg-gray-900">
        <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
            <div class="md:flex md:justify-between">
                <div class="mb-6 md:mb-0">
                    <a href="https://flowbite.com/" class="flex items-center">
                        <!-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 me-3" alt="FlowBite Logo" /> -->
                        <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">Asri Graha</span>
                    </a>
                </div>
                <div class="max-w-sm">
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase text-white">Kontak Kami</h2>
                    <ul class="text-gray-500 text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">+62 82 XXXXXXX</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Jl. Veteran No.184 A, Pandeyan, Kec. Umbulharjo, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55161</a>
                        </li>
                    </ul>
                </div>

            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto border-gray-700 lg:my-8" />
            <div class="sm:flex sm:items-center sm:justify-between">
                <span class="text-sm text-gray-500 sm:text-center text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Asri Graha</a>. All Rights Reserved.
                </span>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>