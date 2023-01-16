<x-show-layout class="bg-slate-800">
	<x-slot:buttons>
		<a href="{{ route('create') }}" class="border border-gray-700 bg-slate-900 p-3 hover:bg-gray-50 hover:bg-opacity-10">Create</a>
	</x-slot>

	<div class="columns-1 sm:columns-2 lg:columns-3 space-y-2 gap-2">
		@foreach ($randomArticles as $article)

		<div class="bg-slate-900 border border-gray-700 p-4 space-y-2 break-inside-avoid">
			<h1 class="text-center text-xl text-gray-300 overflow-ellipsis overflow-hidden whitespace-nowrap">
				<a href="{{ route('show', $article) }}" class="hover:border-b hover:border-gray-400">
					{{ $article->header }}
				</a>
			</h1>

			@isset($article->image)
			<img class="mx-auto" src="{{ asset('storage/' . $article->image) }}" />
			@endisset

			<p class="whitespace-pre-line break-words">{!! $article->foreword !!}</p>
		</div>

		@endforeach
	</div>
</x-show-layout>