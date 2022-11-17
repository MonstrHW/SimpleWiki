<x-layout>
  <x-slot:scripts>
    <script src="{{ asset('scripts/section_actions.js') }}"></script>
    </x-slot>

    @php
    $headerOrImageError = $errors->has('header') || $errors->has('image');
    $sections = old('sections') ?? []
    @endphp

    <div class="mx-auto my-4 max-w-2xl text-sm text-gray-400">
      <form enctype="multipart/form-data" class="flex flex-col gap-2" autocomplete="off" method="post"
        action="{{ route('store') }}">
        @csrf

        <div class="flex gap-2 @if($headerOrImageError) flex-col @endif">
          <x-input-error for="header" class="-mb-2" />
          <input
            class="flex-1 border @error('header') border-red-600 @else border-gray-500 @enderror bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
            type="text" name="header" value="{{ old('header') }}" placeholder="Header..." />
          <x-input-error for="image" class="-mb-2" />
          <input
            class="@if(!$headerOrImageError) max-w-[130px] @endif border @error('image') border-red-600 @else border-gray-500 @enderror bg-slate-900 p-3 file:hidden"
            type="file" name="image" accept="image/png, image/jpeg" />
        </div>

        <x-input-error for="foreword" class="-mb-2" />
        <textarea
          class="block min-h-[84px] border @error('foreword') border-red-600 @else border-gray-500 @enderror bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
          name="foreword" placeholder="Foreword...">{{ old('foreword') }}</textarea>

        <div class="flex flex-col gap-2" id="sections">
          @forelse ($sections as $section)
          <x-section :id="$loop->index" :header="$section['header']" :body="$section['body']" />
          @empty
          <x-section id="0" />
          @endforelse
        </div>

        <button type="submit" class="h-10 w-full border border-gray-500 hover:bg-gray-50 hover:bg-opacity-10">
          Create
        </button>
      </form>
    </div>
</x-layout>