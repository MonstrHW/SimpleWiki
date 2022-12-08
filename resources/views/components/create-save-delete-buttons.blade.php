@props(['article'])

<div class="flex gap-2">
	<button type="submit" class="flex-1 h-10 border border-gray-500 hover:bg-gray-50 hover:bg-opacity-10">
		@if($article->exists)
		Save
		@else
		Create
		@endif
	</button>

	@if($article->exists)
	<form method="post" action="{{ route('destroy', $article) }}">
		@csrf
		@method('delete')
		<button
			class="text-center border border-gray-500 text-red-600 p-2 hover:bg-red-600 hover:text-gray-400 hover:border-red-600"
			type="submit" onclick="return confirm('Are you sure?')">Delete</button>
	</form>
	@endif
</div>