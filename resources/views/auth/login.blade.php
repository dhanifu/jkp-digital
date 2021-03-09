<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/tailwind.css')}}">
    <title>Login</title>
</head>
    <style>
        .split{
            background-image: url({{asset('image/wikrama.png')}})
        }
    </style>
<body>
    <div class="grid grid-cols-1 w-full lg:grid-cols-2 h-screen">
        <div class="split bg-cover w-full hidden lg:block">
            <div class="layer"></div>
            
        </div>
        <div class="w-full bg-gray-100">
            <div class="right flex justify-center items-center h-screen">
                <div class="bg-gray-100 p-8 sm:w-96 w-80 rounded-sm">
                    <div class="text-center text-2xl lg:text-3xl font-semibold md:text-2xl">
                        <h1>JKP Digital</h1>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mt-2">
                            <label for="" class="block">Email</label>
                            <input type="email" name="email" id="email" class="w-full py-1 md:px-2 px-1 border-2 rounded box" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="text-red-600 text-xs" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="block">Password</label>
                            <input type="password" name="password" id="password" class="w-full py-1 md:px-2 px-1 border-2 rounded focus:outline-none box" required autocomplete="current-password">
                            @error('password')
                                <span class="text-red-600 text-xs" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <label class="inline-flex items-center mt-3">
                            <input type="checkbox" class="form-checkbox h-4 w-4 text-blue-500"><span class="ml-2 text-black text-sm">Remember me</span>
                        </label>
    
                        <div>
                            <button type="submit" class="w-full mt-4 bg-blue-700 md:py-2 py-1 text-white font-bold rounded focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>