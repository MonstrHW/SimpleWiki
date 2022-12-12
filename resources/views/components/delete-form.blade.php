@props(['article'])

@if($article->exists)
<form method="post" id="delete_form" action="{{ route('destroy', $article) }}">
	@csrf
	@method('delete')
</form>
@endif