@props(['article'])

@php
$headerError = $errors->has('slug') || $errors->has('header');
$headerOrImageError = $headerError || $errors->has('image');
@endphp

<div class="flex gap-x-1 gap-y-2 @if($headerOrImageError) flex-col @endif">
	<x-input-error for="slug" class="-mb-2" />
	<x-input-error for="header" class="-mb-2" />
	<input
		class="flex-1 border @if($headerError) border-red-600 @else border-gray-500 @enderror bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
		type="text" name="header" value="{{ old('header', $article->header) }}" placeholder="Header..." />

	<x-input-error for="image" class="-mb-2" />
	<div class="border @error('image') border-red-600 @else border-gray-500 @enderror flex">
		<input class="@if(!$headerOrImageError) max-w-[130px] @else w-full @endif bg-slate-900 p-3 file:hidden"
			type="file" name="image" accept="image/png, image/jpeg" />

		@if($article->exists && $article->image)
		<div
			class="relative @if(!$headerOrImageError) w-6 @else w-12 @endif border-l border-gray-500 bg-slate-900 text-gray-400">
			<input class="peer absolute h-full w-full opacity-0" type="checkbox" name="delete_image" />
			<div
				class="flex h-full w-full items-center justify-center peer-checked:bg-gray-50 peer-checked:bg-opacity-10 peer-hover:bg-opacity-10 peer-hover:bg-gray-50">
				<span>×</span>
			</div>
		</div>
		@endif
	</div>
</div>