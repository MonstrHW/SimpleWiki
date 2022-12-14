<x-show-layout>
	<x-slot:buttons>
		<a href="{{ route('edit', $article) }}" class="border border-gray-500 bg-slate-900 p-2">Edit</a>
	</x-slot>

	<h1 class="mb-4 border-b border-gray-500 text-4xl">{{ $article->header }}</h1>

	@isset($article->image)
	<div class="float-right ml-4 mb-4 max-w-lg border bg-gray-900">
		<img src="{{ asset('storage/' . $article->image) }}" />
	</div>
	@endisset

	<p class="mb-2 whitespace-pre-line">{{ $article->foreword }}</p>

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

	@foreach ($article->sections as $section)
	<div class="mb-4 last:mb-0" id="{{ $section->slug }}">
		<h1 class="mb-2 overflow-hidden border-b border-gray-500 text-xl">
			{{ $section->header }}
		</h1>

		<p class="whitespace-pre-line">{{ $section->body }}</p>
	</div>
	@endforeach
</x-show-layout>