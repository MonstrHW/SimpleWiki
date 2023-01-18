<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>
		@isset($title)
		{{ "$title | " . config('app.name') }}
		@else
		{{ config('app.name') }}
		@endisset
	</title>

	@vite('resources/css/app.css')

	@isset($scripts)
	{{ $scripts }}
	@endisset
</head>

<body class="flex flex-col min-h-screen bg-slate-800">
	<header class="text-center my-4 text-gray-300 text-3xl">
		<a href="{{ route('index') }}">Simple Wiki</a>
	</header>

	<div {{ $attributes->merge(['class' => 'flex-1']) }}>
		{{ $slot }}
	</div>

	<footer class="h-2 sm:h-4"></footer>
</body>

</html>