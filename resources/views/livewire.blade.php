<!doctype html>
<html lang="en">

<head>
    <title>Livewire</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <!-- Tailwind CSS -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src={{asset('js/app.js')}}></script>
    @livewireStyles
    @livewireScripts
</head>

<body>
    <div class='px-2 sm:px-16 py-4'>
        <h1 class='text-center text-2xl mb-4'>This is livewire page</h1>
        <h5 class='text-center'>
            <a href='{{url('/')}}'
                class="my-6 font-semibold border-2 border-blue-900 hover:bg-blue-900 hover:text-white p-2">Home</a>
        </h5>
        @livewire('comments')
    </div>
    <script>
        window.Livewire.on('emitEvent', postId => {
        console.log('A post was added with the id of: ' + postId);
    })
    </script>
</body>

</html>