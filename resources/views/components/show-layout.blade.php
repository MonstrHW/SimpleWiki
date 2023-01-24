<x-layout class="flex flex-col gap-y-2">
	@isset($title)
	<x-slot:title>
		{{ $title }}
	</x-slot>
	@endisset

	<x-slot:scripts>
		@vite('resources/js/app.js')
		@vite('resources/js/search.js')
	</x-slot>

	<div class="mx-2 md:mx-10 flex gap-1 text-gray-400 text-sm">
		@isset($buttons)
		{{ $buttons }}
		@endisset

		<div class="relative w-full">
			<input type="text" placeholder="Search..."
				class="peer w-full h-full border border-gray-700 bg-slate-900 p-3 focus:outline-none placeholder-gray-600 focus:placeholder-transparent"
				id="search" autocomplete="off" />

			<div class="peer-focus:flex [&:hover]:flex empty:border-none absolute bg-slate-900 border-gray-700 border-x border-b flex-col hidden"
				id="search_result"></div>
		</div>
	</div>

	<div {{ $attributes->merge(['class' => 'flex-1 mx-2 md:mx-10 text-sm text-gray-400']) }}>
		{{ $slot }}
	</div>
</x-layout>