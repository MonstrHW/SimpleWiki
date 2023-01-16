@props(['article'])

@php
$headerError = $errors->has('slug') || $errors->has('header');
$headerOrImageError = $headerError || $errors->has('image');
@endphp

<div class="flex flex-col gap-x-1 gap-y-2 @if(!$headerOrImageError) sm:flex-row @endif">
	{{-- Header --}}
	<x-input-error for="slug" class="-mb-2" />
	<x-input-error for="header" class="-mb-2" />
	<input
		class="flex-1 border @if($headerError) border-red-600 @else border-gray-700 @enderror bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
		type="text" name="header" value="{{ old('header', $article->header) }}" placeholder="Header..." />

	{{-- Image --}}
	<x-input-error for="image" class="-mb-2" />
	<div class="border @error('image') border-red-600 @else border-gray-700 @enderror flex">
		<input
			class="w-full @if(!$headerOrImageError) sm:max-w-[130px] @endif bg-slate-900 p-3 hover:bg-gray-50 hover:bg-opacity-10 file:hidden"
			type="file" name="image" accept="image/png, image/jpeg" />

		{{-- Remove image button --}}
		@if($article->exists && $article->image)
		<div
			class="relative w-12 @if(!$headerOrImageError) sm:w-6 @endif border-l border-gray-700 bg-slate-900 text-gray-400">
			<input class="peer absolute h-full w-full opacity-0" type="checkbox" name="delete_image" />
			<div
				class="flex h-full w-full text-red-600 items-center justify-center peer-checked:text-gray-400 peer-checked:bg-red-600 peer-hover:text-gray-400 peer-hover:bg-red-600">
				<span>×</span>
			</div>
		</div>
		@endif
	</div>
</div>