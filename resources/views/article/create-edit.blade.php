<x-layout>
	<x-slot:scripts>
		<script src="{{ asset('scripts/section_actions.js') }}"></script>
	</x-slot>

	@php
	$sections = old('sections', $article->sections) ?? [];
	@endphp

	<div class="mx-auto my-4 max-w-2xl text-sm text-gray-400">
		<x-create-edit-form :article="$article">

			<x-header-image :article="$article" />

			<x-input-error for="foreword" class="-mb-2" />
			<textarea
				class="block min-h-[84px] border @error('foreword') border-red-600 @else border-gray-500 @enderror bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
				name="foreword" placeholder="Foreword...">{{ old('foreword', $article->foreword) }}</textarea>

			<div class="flex flex-col gap-2" id="sections">
				@forelse ($sections as $section)
				<x-section :id="$loop->index" :header="$section['header']" :body="$section['body']" />
				@empty
				<x-section id="0" />
				@endforelse
			</div>

			<x-create-save-delete-buttons :article="$article" />

		</x-create-edit-form>
	</div>
</x-layout>