<x-show-layout>
	<x-slot:buttons>
		<a href="{{ route('create') }}" class="border border-gray-500 bg-slate-900 p-2">Create</a>
	</x-slot>

	<div class="columns-1 sm:columns-2 lg:columns-3 space-y-4">
		@foreach ($randomArticles as $article)

		<div class="max-w-96 border border-gray-600 px-4 py-2 space-y-2 break-inside-avoid">
			<h1 class="text-center text-xl text-gray-300 overflow-ellipsis overflow-hidden whitespace-nowrap">
				<a href="{{ route('show', $article) }}" class="hover:border-b hover:border-gray-400">
					{{ $article->header }}
				</a>
			</h1>

			@isset($article->image)
			<img class="mx-auto" src="{{ asset('storage/' . $article->image) }}" />
			@endisset

			<p class="whitespace-pre-line">{!! $article->foreword !!}</p>
		</div>

		@endforeach
	</div>
</x-show-layout>