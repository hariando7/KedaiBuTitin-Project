<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KedaiBuTitin')</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include Flowbite CSS -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.4/dist/flowbite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">
    <div class="font-[sans-serif]">
        <div class="min-h-screen flex fle-col items-center justify-center py-6 px-4">
            @yield('content')
        </div>
    </div>
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