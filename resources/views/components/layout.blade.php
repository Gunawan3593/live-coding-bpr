<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
        </script>
        <title>BPR KAS | Live Coding</title>
    </head>
    <body class="mb-48">
        <nav class="flex flex-col lg:flex-row lg:justify-between  items-center">
            <a href="/" class="font-bold">
                BPR KAS Indonesia
            </a>
            <ul class="flex flex-col lg:flex-row items-center lg:space-x-6 mr-6 text-lg">
              <li>
                  <a href="/customers" class="hover:text-laravel"
                      ><i class="fa-solid fa-user"></i>
                      Customers</a
                  >
              </li>
              <li>
                  <a href="/bank-accounts" class="hover:text-laravel"
                      ><i class="fa-solid fa-usd"></i>
                      Bank Accounts</a
                  >
              </li>
              <li>
                  <a href="/transfer-banks" class="hover:text-laravel"
                      ><i class="fa-solid fa-exchange"></i>
                      Transfer Banks</a
                  >
              </li>
              <li>
                  <a href="/transactions" class="hover:text-laravel"
                      ><i class="fa-solid fa-clock"></i>
                      Transactions</a
                  >
              </li>
            </ul>
        </nav>
        
        <main>
          {{ $slot }}
        </main>

        <footer
            class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
        >
            <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>
        </footer>
        <x-flash-message></x-flash-message>
    </body>
</html>