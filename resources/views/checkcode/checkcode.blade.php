<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tailwind-Css Login Form</title>
    <!-- Tailwind-CSS CDN  -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-500">
<!-- Login Form -->
<div class="container mx-auto p-2">
    <div class="max-w-sm mx-auto my-24 bg-white px-5 py-10 rounded shadow-xl">
        <div class="text-center mb-8">
            <h1 class="font-bold text-2xl font-bold">Login To WEBZONE</h1>
        </div>
        <form action="{{route('checkcodepost')}}" method="post">
            @csrf

            <div class="mt-5">
                <label for="code">code</label>
                <input
                    name="code"
                    type="text"
                    id="code"
                    class="block w-full p-2 border rounded border-gray-500"
                />
            </div>

            <div class="mt-10">
                <button
                    type="submit"
                    value="Login"
                    class="py-3 bg-green-500 hover:bg-green-600 rounded text-white text-center w-full"
                >login</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
