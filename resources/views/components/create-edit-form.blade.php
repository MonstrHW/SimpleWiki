@props(['article'])

@php
$route = $article->exists ? route('update', $article) : route('store');
@endphp

<form enctype="multipart/form-data" class="flex flex-col gap-2" autocomplete="off" method="post" action="{{ $route }}">
	@if($article->exists)
	@method('put')
	@endif

	@csrf

	{{ $slot }}
</form>