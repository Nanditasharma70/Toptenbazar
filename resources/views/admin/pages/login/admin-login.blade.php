<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login - Top Ten Bazaar</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="">

    <div class="grid grid-cols-1 md:grid-cols-2 w-full h-full rounded-lg bg-white">

        <!-- Left Illustration -->
        <div class="w-full md:h-screen bg-orange-100">
            <img src="{{ asset('assets/images/loginimage.png') }}" alt="Cashier Illustration"
                class="w-full md:h-screen object-fill" />
        </div>

        <!-- Right Login Form -->
        <div class="flex flex-col md:justify-center justify-start h-screen p-8 sm:p-12">
            <!-- Logo and Welcome Text -->
            <div class="mb-6">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Top Ten Bazaar Logo" class="h-12 mb-4" />
                <h2 class="text-2xl font-bold text-gray-800 leading-snug">
                    Welcome Back! Sign In To Manage<br />
                    Your Store Efficiently.
                </h2>
            </div>

            <!-- Login Form -->
            <form action="{{ route('authenticate') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input id="email" name="email" type="email" placeholder="Enter Email Address"
                        class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm" />
                </div>
                @if ($errors->has('email'))
                    <p class="text-red-500 text-sm">{{ $errors->first('email') }}</p>
                @endif

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input id="password" name="password" type="password" placeholder="Enter Password"
                        class="mt-1 block w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-green-500 text-sm" />
                </div>
                @if ($errors->has('password'))
                    <p class="text-red-500 text-sm">{{ $errors->first('password') }}</p>
                @endif

                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded" />
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Remember Me
                    </label>
                </div>

                <div>
                    <input
                        class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md font-semibold transition text-sm cursor-pointer"
                        type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>

</body>
</html>
