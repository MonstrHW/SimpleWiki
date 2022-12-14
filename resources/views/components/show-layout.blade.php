<x-layout>
	<x-slot:scripts>
		@vite('resources/js/app.js')
		@vite('resources/js/search.js')
	</x-slot>

	<div class="mx-10 mb-2 flex gap-1 text-gray-400">
		@isset($buttons)
		{{ $buttons }}
		@endisset

		<div class="relative w-full">
			<input type="text" placeholder="Search..."
				class="peer w-full h-full border border-gray-500 bg-slate-900 px-2 focus:outline-none" id="search"
				autocomplete="off" />

			<div class="peer-focus:flex hover:flex empty:border-none absolute bg-slate-900 border-gray-500 border-x border-b flex-col hidden"
				id="search_result"></div>
		</div>
	</div>

	<div class="mx-10 mb-4 min-h-screen border border-gray-500 bg-slate-900 p-6 text-sm text-gray-400">
		{{ $slot }}
	</div>
</x-layout>