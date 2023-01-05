<x-layout>
	<x-slot:title>
		{{ $article->exists ? 'Edit: ' . $article->header : 'Create Article' }}
	</x-slot>

	<x-slot:scripts>
		<script src="{{ asset('scripts/section_actions.js') }}"></script>
		@vite('resources/js/text_customize.js')
	</x-slot>

	@php
	$sections = old('sections', $article->sections) ?? [];

	$getBody = fn($section) => is_array($section) ? $section['body'] : $section->getRawOriginal('body');
	@endphp

	<div class="mx-auto my-4 max-w-2xl text-sm text-gray-400">
		<x-create-edit-form :article="$article">

			<x-header-image :article="$article" />

			{{-- Foreword --}}
			<x-input-error for="foreword" class="-mb-2" />
			<div class="flex flex-col border @error('foreword') border-red-600 @else border-gray-500 @enderror">
				<x-text-customize-menu />

				<textarea
					class="min-h-[84px] bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
					name="foreword" placeholder="Foreword...">{{ old('foreword', $article->getRawOriginal('foreword')) }}</textarea>
			</div>

			{{-- Sections --}}
			<div class="flex flex-col gap-2" id="sections">
				@forelse ($sections as $section)
				<x-section :id="$loop->index" :header="$section['header']" :body="$getBody($section)" />
				@empty
				<x-section id="0" />
				@endforelse
			</div>

			<x-create-save-delete-buttons :article="$article" />

		</x-create-edit-form>

		<x-delete-form :article="$article" />
	</div>
</x-layout>