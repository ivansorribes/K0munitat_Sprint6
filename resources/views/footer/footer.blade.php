<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @viteReactRefresh
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
</head>
<body>
</body>
    <footer class="bg-[#000000] mx-auto max-w-full  shadow">
        <div class="container mx-auto w-full max-w-full px-6 py-14 lg:py-8 border-t border-b border-gray-200 dark:border-gray-700">
            <div class="md:flex md:justify-between">
              <div class="mb-6 md:mb-0">
                  <a href="{{ route('about-us') }}" class="flex items-center">
                      <img src="{{ asset('img/logo.png') }}" class="hover:scale-110 h-8 me-3" alt="Logo Komunitat" />
                      <span class="self-center text-2xl font-semibold whitespace-nowrap"></span>
                  </a>
              </div>
              <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                  <div>
                      <h2 class="mb-6 text-sm font-semibold text-[#fffdf9] uppercase">Resources</h2>
                      <ul class="text-[#fffdf9] font-medium">
                          <li class="mb-4">
                              <a href="https://flowbite.com/" class="hover:underline">Home</a>
                          </li>
                          <li class="mb-4">
                              <a href="https://tailwindcss.com/" class="hover:underline">Blog</a>
                          </li>
                          <li class="mb-4">
                            <a href="https://tailwindcss.com/" class="hover:underline">Communities</a>
                          </li>
                      </ul>
                  </div>
                  <div>
                      <h2 class="mb-6 text-sm font-semibold text-[#fffdf9] uppercase">Follow us</h2>
                      <ul class="text-[#fffdf9] font-medium">
                          <li class="mb-4">
                              <a href="https://github.com/themesberg/flowbite" class="hover:underline ">Facebook</a>
                          </li>
                          <li>
                              <a href="https://discord.gg/4eeurUVvTy" class="hover:underline">Instagram</a>
                          </li>
                      </ul>
                  </div>
                  <div>
                      <h2 class="mb-6 text-sm font-semibold text-[#fffdf9] uppercase">Legal</h2>
                      <ul class="text-[#fffdf9] dark:text-gray-400 font-medium">
                          <li class="mb-4">
                              <a href="#" class="hover:underline">Privacy Policy</a>
                          </li>
                          <li>
                              <a href="#" class="hover:underline">Terms &amp; Conditions</a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
          <hr class="my-6 border-gray-200 sm:mx-auto lg:my-8" />
          <div class="sm:flex sm:items-center sm:justify-between">
              <span class="text-sm text-gray-500 sm:text-center">© 2024 <a href="https://flowbite.com/" class="hover:underline">Komunitat™</a>. All Rights Reserved.
              </span>

          </div>
        </div>
    </footer>
    

</html>