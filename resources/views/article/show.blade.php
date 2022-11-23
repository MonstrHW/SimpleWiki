<x-layout>
	<!-- Options menu and search-->
	<div class="mx-10 mb-2 mt-4 flex flex-wrap gap-1 text-gray-400">
		<a href="" class="border border-gray-500 bg-slate-900 p-2">Edit</a>
		<input type="text" placeholder="Search..."
			class="flex-1 border border-gray-500 bg-slate-900 px-2 focus:bg-slate-700 focus:outline-none" />
	</div>

	<!-- Main page -->
	<div class="mx-10 mb-4 min-h-screen border border-gray-500 bg-slate-900 p-6 text-sm text-gray-400">
		<!-- Header -->
		<h1 class="mb-4 border-b border-gray-500 text-2xl">{{ $article->header }}</h1>

		<!-- Image column-->
		@isset($article->image)
		<div class="float-right ml-4 mb-4 w-full max-w-xs border bg-gray-900">
			<h2 class="bg-slate-800 text-center text-lg">{{ $article->header }}</h2>
			<img src="{{ asset('storage/' . $article->image) }}" class="m-auto" />
		</div>
		@endisset

		<!-- Foreword -->
		<p class="mb-2">
			{{ $article->foreword }}
		</p>

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
		<div class="mb-4" id="{{ $section->slug }}">
			<h1 class="mb-2 overflow-hidden border-b border-gray-500 text-xl">
				{{ $section->header }}
			</h1>

			{{ $section->body }}
		</div>
		@endforeach
	</div>
	</body>
</x-layout>