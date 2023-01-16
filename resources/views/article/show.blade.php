<x-show-layout class="bg-slate-900 border border-gray-700 p-4 sm:p-6">
	<x-slot:title>
		{{ $article->header }}
	</x-slot>

	<x-slot:buttons>
		<a href="{{ route('edit', $article) }}" class="border border-gray-700 bg-slate-900 p-3 hover:bg-gray-50 hover:bg-opacity-10">Edit</a>
	</x-slot>

	{{-- Header --}}
	<h1 class="mb-4 border-b border-gray-700 text-gray-300 text-2xl">{{ $article->header }}</h1>

	{{-- Image --}}
	@isset($article->image)
	<div class="max-w-xs w-fit mb-4 sm:float-right sm:ml-4 lg:max-w-md">
		<img src="{{ asset('storage/' . $article->image) }}" />
	</div>
	@endisset

	{{-- Foreword --}}
	<p class="mb-2 whitespace-pre-line break-words">{!! $article->foreword !!}</p>

	{{-- Sections menu --}}
	@if ($article->sections->isNotEmpty())
	<div class="w-fit mb-4 border border-gray-700 bg-slate-800 p-2">
		<details open>
			<summary class="text-center text-gray-300">Contents</summary>

			<ol class="mt-2 list-inside list-decimal">
				@foreach ($article->sections as $section)
				<li>
					<a class="hover:underline text-[#E15119]" href="#{{ $section->slug }}">
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
		<h1 class="mb-2 overflow-hidden border-b border-gray-700 text-gray-300 text-xl">
			{{ $section->header }}
		</h1>

		<p class="whitespace-pre-line break-words">{!! $section->body !!}</p>
	</div>
	@endforeach
</x-show-layout>