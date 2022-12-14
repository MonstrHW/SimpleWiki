<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	@vite('resources/css/app.css')

	@isset($scripts)
	{{ $scripts }}
	@endisset
</head>

<body class="bg-slate-800">
	<header class="text-center my-4 text-gray-300 text-3xl">
		<a href="{{ route('index') }}">Simple Wiki</a>
	</header>

	{{ $slot }}
</body>

</html>