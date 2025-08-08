<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       <head>
            @include('components.metas') 
        </head>
        <style>
            .logout-btn {
                cursor: pointer;
            }
        </style>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <div class="text-center">
            <h1>Hello, World</h1>
            <span class="logout-btn">Logout</span>
        </div>
    </body>
    <script>
        $('.logout-btn').click(function() {
            const myRouteUrl = "{{ route('handle.logout') }}"
            window.location.href = myRouteUrl;
        })
    </script>
</html>