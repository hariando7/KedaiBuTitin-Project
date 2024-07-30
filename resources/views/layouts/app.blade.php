<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KedaiBuTitin')</title>
    <link rel="icon" href="/Logo.ico" type="image/x-icon">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.4/dist/flowbite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">
    <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar"
        aria-controls="separator-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-orange-700 dark:hover:bg-orange-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="separator-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">
        <form class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-orange-400" method="POST"
            action="{{ route('logout') }}">
            @csrf
            <ul class="space-y-2 font-medium">
                <div class="flex items-center ps-2.5 mb-5">
                    <img src="/Logo.jfif" class="h-9 me-3 sm:h-9 rounded-full" alt="Flowbite Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Kedai Ibu
                        Titin</span>
                    <button type="button" id="dark-mode-toggle" class="p-2 rounded flex m-auto">
                        <svg class="w-5 h-5 dark:text-white" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="m 8 0 c -0.550781 0 -1 0.449219 -1 1 s 0.449219 1 1 1 s 1 -0.449219 1 -1 s -0.449219 -1 -1 -1 z m -4.949219 2.050781 c -0.257812 0 -0.511719 0.097657 -0.707031 0.292969 c -0.390625 0.390625 -0.390625 1.023438 0 1.414062 c 0.390625 0.390626 1.023438 0.390626 1.414062 0 c 0.390626 -0.390624 0.390626 -1.023437 0 -1.414062 c -0.195312 -0.195312 -0.449218 -0.292969 -0.707031 -0.292969 z m 9.898438 0 c -0.257813 0 -0.511719 0.097657 -0.707031 0.292969 c -0.390626 0.390625 -0.390626 1.023438 0 1.414062 c 0.390624 0.390626 1.023437 0.390626 1.414062 0 c 0.390625 -0.390624 0.390625 -1.023437 0 -1.414062 c -0.195312 -0.195312 -0.449219 -0.292969 -0.707031 -0.292969 z m -4.949219 0.949219 c -2.761719 0 -5 2.238281 -5 5 s 2.238281 5 5 5 s 5 -2.238281 5 -5 s -2.238281 -5 -5 -5 z m 0 2 c 0.183594 0 0.367188 0.019531 0.550781 0.050781 c -0.910156 0.210938 -1.550781 1.019531 -1.550781 1.949219 c 0 1.105469 0.894531 2 2 2 c 0.929688 0 1.738281 -0.644531 1.949219 -1.550781 c 0.03125 0.179687 0.050781 0.367187 0.050781 0.550781 c 0 1.65625 -1.34375 3 -3 3 s -3 -1.34375 -3 -3 s 1.34375 -3 3 -3 z m -7 2 c -0.550781 0 -1 0.449219 -1 1 s 0.449219 1 1 1 s 1 -0.449219 1 -1 s -0.449219 -1 -1 -1 z m 14 0 c -0.550781 0 -1 0.449219 -1 1 s 0.449219 1 1 1 s 1 -0.449219 1 -1 s -0.449219 -1 -1 -1 z m -11.949219 4.949219 c -0.257812 0 -0.511719 0.097656 -0.707031 0.292969 c -0.390625 0.390624 -0.390625 1.023437 0 1.414062 s 1.023438 0.390625 1.414062 0 c 0.390626 -0.390625 0.390626 -1.023438 0 -1.414062 c -0.195312 -0.195313 -0.449218 -0.292969 -0.707031 -0.292969 z m 9.898438 0 c -0.257813 0 -0.511719 0.097656 -0.707031 0.292969 c -0.390626 0.390624 -0.390626 1.023437 0 1.414062 c 0.390624 0.390625 1.023437 0.390625 1.414062 0 s 0.390625 -1.023438 0 -1.414062 c -0.195312 -0.195313 -0.449219 -0.292969 -0.707031 -0.292969 z m -4.949219 2.050781 c -0.550781 0 -1 0.449219 -1 1 s 0.449219 1 1 1 s 1 -0.449219 1 -1 s -0.449219 -1 -1 -1 z m 0 0"
                                    fill="currentColor"></path>
                            </g>
                        </svg>
                    </button>
                </div>
                {{-- <li>
                    <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="ms-3 dark:text-white">Dashboard</span>
                    </a>
                </li> --}}
                <li>
                    <a href="{{ route('menus.index') }}"
                        class="flex items-center p-1 text-gray-900 rounded-lg dark:hover:bg-orange-900 group {{ Request::routeIs(['menus.index', 'menus.create', 'menus.edit']) ? 'bg-gray-100 dark:bg-orange-700' : '' }}">
                        <svg class="flex-shrink-0 w-7 h-7 text-gray-500 transition duration-75 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white"
                            height="200px" width="200px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"
                            fill="currentColor">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <style type="text/css">
                                    .st0 {
                                        fill: currentColor;
                                    }
                                </style>
                                <g>
                                    <path class="st0"
                                        d="M418.089,47.697l-15.133-24.248c3.545-2.263,5.913-6.214,5.913-10.726C408.869,5.696,403.18,0,396.147,0 H112.098C98.843,0,86.765,5.402,78.092,14.089c-8.688,8.652-14.306,20.759-14.306,33.993v422.023 c0,23.134,18.762,41.895,41.896,41.895h307.237c19.49,0,35.296-15.792,35.296-35.275V82.467 C448.215,64.742,435.099,50.24,418.089,47.697z M151.738,180.34l27.996,33.145c2.2,2.614,5.886,3.118,8.225,1.136l1.149-0.96 c2.34-1.983,2.48-5.703,0.266-8.316l-28.15-33.334c-5.676-6.718-3.293-12.169,0.616-15.469c3.909-3.3,9.682-4.736,15.357,1.983 l28.15,33.334c2.2,2.613,5.899,3.11,8.239,1.128l1.135-0.96c2.34-1.976,2.48-5.696,0.266-8.309l-27.996-33.152 c-10.159-12.029,5.66-24.682,15.581-12.926c11.896,14.082,26.441,31.309,26.441,31.309c18.341,21.565,18.412,31.12,16.408,44.355 c-1.611,10.663-4.288,18.243,7.09,31.722l3.615,4.274l-15.959,18.895l-6.292-7.433c-11.377-13.48-19.294-12.114-30.083-12.303 c-13.382-0.238-22.784-1.934-40.971-23.616c0,0-14.544-17.228-26.44-31.31C126.461,181.783,141.579,168.304,151.738,180.34z M204.829,448.226h-9.038v-27.33l-8.968,18.972h-6.46l-9.234-19.077v27.436h-9.024V400.06h8.659l12.821,27.309l12.568-27.309h8.674 V448.226z M250.115,408.376h-22.489v11.448h19.183v8.253h-19.183v11.833h22.489v8.316h-31.513V400.06h31.513V408.376z M298.315,448.226h-7.972l-19.757-30.084v30.084h-9.024V400.06h7.973l19.756,30.02v-30.02h9.024V448.226z M269.199,302.586 l15.96-18.902l47.01,55.676l-18.622,15.743L269.199,302.586z M346.601,431.656c0,2.508-0.462,4.834-1.345,6.914 c-0.897,2.088-2.158,3.896-3.741,5.367c-1.584,1.464-3.475,2.62-5.619,3.447c-2.13,0.812-4.456,1.226-6.908,1.226 c-2.438,0-4.764-0.414-6.908-1.226c-2.144-0.827-4.021-1.99-5.576-3.454c-1.57-1.472-2.816-3.272-3.699-5.36 c-0.897-2.08-1.345-4.406-1.345-6.914V400.06h9.024v31.274c0,2.823,0.77,5.051,2.298,6.613c1.541,1.583,3.572,2.347,6.207,2.347 s4.68-0.77,6.249-2.354c1.57-1.584,2.326-3.748,2.326-6.607V400.06h9.038V431.656z M367.086,181.405 c-6.418,15.644-17.95,44.347-30.841,59.627c-29.985,37.608-30.392,3.538-55.108,31.94l-69.359,82.131l-18.537-15.665l-0.309,0.182 c0,0,0.084-0.106,0.21-0.253c2.928-3.461,44.179-52.306,79.672-94.348c35.114-41.58,64.426-76.302,70.605-83.609 C356.087,146.396,377.105,157.052,367.086,181.405z M90.198,48.65v-0.568c0-5.57,2.382-11.14,6.529-15.28 c4.134-4.147,9.57-6.396,15.371-6.396h261.573l13.886,22.244H90.198z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap dark:text-white">Menu</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('stocks.index') }}"
                        class="flex items-center p-1 text-gray-900 rounded-lg group {{ Request::routeIs(['stocks.index', 'stocks.create', 'stocks.edit']) ? 'bg-gray-100 dark:bg-orange-700' : '' }}">
                        <svg class="flex-shrink-0 w-7 h-7 text-gray-500 transition duration-75 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white"
                            viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M18.8832 4.69719C19.2737 4.30667 19.9069 4.30667 20.2974 4.69719L23.888 8.28778L27.469 4.7068C27.8595 4.31628 28.4927 4.31628 28.8832 4.7068C29.2737 5.09733 29.2737 5.73049 28.8832 6.12102L25.3022 9.702L28.7827 13.1825C29.1732 13.573 29.1732 14.2062 28.7827 14.5967C28.3922 14.9872 27.759 14.9872 27.3685 14.5967L23.888 11.1162L20.3979 14.6063C20.0074 14.9968 19.3743 14.9968 18.9837 14.6063C18.5932 14.2158 18.5932 13.5826 18.9837 13.1921L22.4738 9.702L18.8832 6.1114C18.4927 5.72088 18.4927 5.08771 18.8832 4.69719Z"
                                    fill="currentColor"></path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M23.86 15.0513C24.0652 14.9829 24.2871 14.9829 24.4923 15.0513L39.2705 19.9765C39.4691 20.0336 39.6499 20.1521 39.783 20.323L43.7861 25.4612C43.9857 25.7173 44.0485 26.0544 43.9545 26.3652C43.8902 26.5779 43.7579 26.7602 43.5821 26.887L28.1827 32.0159L24.965 27.8858C24.7754 27.6424 24.4839 27.5001 24.1753 27.5004C23.8667 27.5007 23.5755 27.6434 23.3863 27.8871L20.186 32.0093L4.74236 26.8577C4.58577 26.7329 4.46805 26.5621 4.40853 26.3652C4.31456 26.0544 4.37733 25.7173 4.57688 25.4612L8.50799 20.4154C8.62826 20.2191 8.81554 20.0652 9.04466 19.9889L23.86 15.0513ZM35.8287 20.9376L24.1802 24.8197L12.5277 20.9362L24.1762 17.0541L35.8287 20.9376Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M28.1442 34.1368L39.991 30.1911L39.9905 36.7628C39.9905 38.054 39.1642 39.2003 37.9392 39.6086L25.1762 43.863V31.4111L27.0393 33.8026C27.2997 34.1368 27.7423 34.2706 28.1442 34.1368Z"
                                    fill="currentColor"></path>
                                <path
                                    d="M23.1762 31.4191V43.863L10.4131 39.6086C9.18811 39.2003 8.36183 38.054 8.36175 36.7628L8.36132 30.1732L20.2251 34.1306C20.6277 34.2649 21.0712 34.1305 21.3314 33.7953L23.1762 31.4191Z"
                                    fill="currentColor"></path>
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap dark:text-white">Stok</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('orders.index') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg group {{ Request::routeIs(['orders.index', 'orders.create', 'orders.edit']) ? 'bg-gray-100 dark:bg-orange-700' : '' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap dark:text-white">Pesanan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('orders.report') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg group {{ Request::routeIs(['orders.report']) ? 'bg-gray-100 dark:bg-orange-700' : '' }}">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white"
                            viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" fill="currentColor">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <title>report-linechart</title>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="add" fill="currentColor" transform="translate(42.666667, 85.333333)">
                                        <path
                                            d="M341.333333,1.42108547e-14 L426.666667,85.3333333 L426.666667,341.333333 L3.55271368e-14,341.333333 L3.55271368e-14,1.42108547e-14 L341.333333,1.42108547e-14 Z M330.666667,42.6666667 L42.6666667,42.6666667 L42.6666667,298.666667 L384,298.666667 L384,96 L330.666667,42.6666667 Z M106.666667,85.3333333 L106.666333,217.591333 L167.724208,141.269742 L232.938667,173.866667 L280.864376,130.738196 L295.135624,146.595138 L236.398693,199.458376 L173.589333,168.064 L120.324333,234.666333 L341.333333,234.666667 L341.333333,256 L85.3333333,256 L85.3333333,85.3333333 L106.666667,85.3333333 Z"
                                            id="Combined-Shape"> </path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap dark:text-white">Rekap Pesanan</span>
                    </a>
                </li>
            </ul>
            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-white">
                <li>
                    @if (Route::has('logout'))
                    <button type="submit" href="{{ route('logout') }}"
                        class="w-full text-left mb-10 flex items-center p-2 text-gray-900 rounded-lg group">
                        <svg class="flex-shrink-0 w-7 h-7 text-gray-500 transition duration-75 dark:text-white group-hover:text-gray-900 dark:group-hover:text-white"
                            viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.5 9.56757V14.4324C3.5 16.7258 3.5 17.8724 4.22161 18.5849C4.87719 19.2321 5.89578 19.2913 7.81846 19.2968C7.71686 18.6224 7.69563 17.8168 7.69029 16.8689C7.68802 16.4659 8.01709 16.1374 8.42529 16.1351C8.83348 16.1329 9.16624 16.4578 9.16851 16.8608C9.17451 17.9247 9.20249 18.6789 9.30898 19.2512C9.41158 19.8027 9.57634 20.1219 9.81626 20.3588C10.089 20.6281 10.4719 20.8037 11.1951 20.8996C11.9395 20.9985 12.9261 21 14.3407 21H15.3262C16.7407 21 17.7273 20.9985 18.4717 20.8996C19.1949 20.8037 19.5778 20.6281 19.8505 20.3588C20.1233 20.0895 20.3011 19.7114 20.3983 18.9975C20.4984 18.2626 20.5 17.2885 20.5 15.8919V8.10811C20.5 6.71149 20.4984 5.73743 20.3983 5.0025C20.3011 4.28855 20.1233 3.91048 19.8505 3.6412C19.5778 3.37192 19.1949 3.19635 18.4717 3.10036C17.7273 3.00155 16.7407 3 15.3262 3H14.3407C12.9261 3 11.9395 3.00155 11.1951 3.10036C10.4719 3.19635 10.089 3.37192 9.81626 3.6412C9.57634 3.87807 9.41158 4.19728 9.30898 4.74877C9.20249 5.32112 9.17451 6.07525 9.16851 7.1392C9.16624 7.54221 8.83348 7.8671 8.42529 7.86485C8.01709 7.86261 7.68802 7.53409 7.69029 7.13107C7.69563 6.18322 7.71686 5.37758 7.81846 4.70325C5.89578 4.70867 4.87719 4.76789 4.22161 5.41515C3.5 6.12759 3.5 7.27425 3.5 9.56757ZM5.93385 12.516C5.6452 12.231 5.6452 11.769 5.93385 11.484L7.90484 9.53806C8.19348 9.25308 8.66147 9.25308 8.95011 9.53806C9.23876 9.82304 9.23876 10.2851 8.95011 10.5701L8.24088 11.2703L15.3259 11.2703C15.7341 11.2703 16.0651 11.597 16.0651 12C16.0651 12.403 15.7341 12.7297 15.3259 12.7297L8.24088 12.7297L8.95011 13.4299C9.23876 13.7149 9.23876 14.177 8.95011 14.4619C8.66147 14.7469 8.19348 14.7469 7.90484 14.4619L5.93385 12.516Z"
                                    fill="currentColor"></path>
                            </g>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap dark:text-white">Keluar</span>
                    </button>
                    @endif
                </li>
            </ul>
        </form>
    </aside>

    <div class="sm:ml-64 min-h-screen flex flex-col">
        <div class="p-4 m-4 border-2 border-orange-200 border-dashed rounded-lg flex-grow">
            @yield('content')
        </div>
        <footer class="relative flex justify-center bottom-0 p-4">
            <div
                class="absolute inset-x-0 top-1/2 h-px -translate-y-1/2 bg-transparent bg-gradient-to-r from-transparent via-gray-500 to-transparent opacity-75">
            </div>
            <span class="relative z-10 bg-white px-6 text-sm lg:text-lg text-orange-400">Dibuat Oleh Kedai Ibu
                Titin</span>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script>
        const toggleDarkMode = () => {
          const isDarkMode = document.documentElement.classList.toggle('dark');
          localStorage.setItem('dark-mode', isDarkMode);
        }
        document.addEventListener('DOMContentLoaded', () => {
          const isDarkMode = localStorage.getItem('dark-mode') === 'true';
          if (isDarkMode) {
            document.documentElement.classList.add('dark');
          }
        });
        document.getElementById('dark-mode-toggle').addEventListener('click', toggleDarkMode);
    </script>
</body>

</html>