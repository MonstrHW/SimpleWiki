@props(['article'])

<div class="flex gap-1">
	<button type="submit" class="flex-1 p-3 border border-gray-700 bg-slate-900 hover:bg-gray-50 hover:bg-opacity-10">
		@if($article->exists)
		Save
		@else
		Create
		@endif
	</button>

	@if($article->exists)
	<button
		class="text-center bg-slate-900 border border-gray-700 text-red-600 p-3 hover:bg-red-600 hover:text-gray-400 hover:border-red-600"
		type="submit" onclick="return confirm('Are you sure?')" form="delete_form">Delete</button>
	@endif
</div>