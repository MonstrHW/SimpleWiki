<x-layout>
	<x-slot:scripts>
		@vite('resources/js/app.js')
		@vite('resources/js/search.js')
	</x-slot>

	<!-- Options menu and search-->
	<div class="mx-10 mb-2 mt-4 flex gap-1 text-gray-400">
		<a href="{{ route('edit', $article) }}" class="border border-gray-500 bg-slate-900 p-2">Edit</a>

		<div class="relative w-full">
			<input type="text" placeholder="Search..."
				class="peer w-full h-full border border-gray-500 bg-slate-900 px-2 focus:outline-none" id="search"
				autocomplete="off" />

			<div class="peer-focus:flex hover:flex empty:border-none absolute bg-slate-900 border-gray-500 border-x border-b flex-col hidden"
				id="search_result"></div>
		</div>

	</div>

	<!-- Main page -->
	<div class="mx-10 mb-4 min-h-screen border border-gray-500 bg-slate-900 p-6 text-sm text-gray-400">
		<!-- Header -->
		<h1 class="mb-4 border-b border-gray-500 text-4xl">{{ $article->header }}</h1>

		<!-- Image column-->
		@isset($article->image)
		<div class="float-right ml-4 mb-4 max-w-lg border bg-gray-900">
			<img src="{{ asset('storage/' . $article->image) }}" />
		</div>
		@endisset

		<!-- Foreword -->
		<p class="mb-2 whitespace-pre-line">{{ $article->foreword }}</p>

		<!-- Contents menu -->
		@if ($article->sections->isNotEmpty())
		<div class="mb-4 inline-block border bg-slate-800 p-2">
			<details open>
				<summary class="text-center">Contents</summary>

				<ol class="mt-2 list-inside list-decimal">
					@foreach ($article->sections as $section)
					<a class="hover:underline" href="#{{ $section->slug }}">
						<li>{{ $section->header }}</li>
					</a>
					@endforeach
				</ol>
			</details>
		</div>
		@endif

		<!-- Sections -->
		@foreach ($article->sections as $section)
		<div class="mb-4 last:mb-0" id="{{ $section->slug }}">
			<h1 class="mb-2 overflow-hidden border-b border-gray-500 text-xl">
				{{ $section->header }}
			</h1>

			<p class="whitespace-pre-line">{{ $section->body }}</p>
		</div>
		@endforeach
	</div>
	</body>
</x-layout>