<x-show-layout>
	<x-slot:title>
		{{ $article->header }}
	</x-slot>
	
	<x-slot:buttons>
		<a href="{{ route('edit', $article) }}" class="border border-gray-500 bg-slate-900 p-2">Edit</a>
	</x-slot>

	{{-- Header --}}
	<h1 class="mb-4 border-b border-gray-500 text-4xl">{{ $article->header }}</h1>

	{{-- Image --}}
	@isset($article->image)
	<div class="float-right ml-4 mb-4 max-w-lg border bg-gray-900">
		<img src="{{ asset('storage/' . $article->image) }}" />
	</div>
	@endisset

	{{-- Foreword --}}
	<p class="mb-2 whitespace-pre-line break-words">{!! $article->foreword !!}</p>

	{{-- Sections menu --}}
	@if ($article->sections->isNotEmpty())
	<div class="mb-4 inline-block border bg-slate-800 p-2">
		<details open>
			<summary class="text-center">Contents</summary>

			<ol class="mt-2 list-inside list-decimal">
				@foreach ($article->sections as $section)
				<li>
					<a class="hover:underline" href="#{{ $section->slug }}">
						{{ $section->header }}
					</a>
				</li>
				@endforeach
			</ol>
		</details>
	</div>
	@endif

	{{-- Sections --}}
	@foreach ($article->sections as $section)
	<div class="mb-4 last:mb-0" id="{{ $section->slug }}">
		<h1 class="mb-2 overflow-hidden border-b border-gray-500 text-xl">
			{{ $section->header }}
		</h1>

		<p class="whitespace-pre-line break-words">{!! $section->body !!}</p>
	</div>
	@endforeach
</x-show-layout>