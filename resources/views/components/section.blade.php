@php
$error = $errors->has("sections.$id.slug")
|| $errors->has("sections.$id.header")
|| $errors->has("sections.$id.body");
@endphp

<div class="flex flex-col" id="section{{ $id }}">
    <x-input-error for="sections.{{ $id }}.slug" />
    <x-input-error for="sections.{{ $id }}.header" />
    <x-input-error for="sections.{{ $id }}.body" />

    <div class="flex">
        <div class="w-full border @if($error) border-red-600 @else border-gray-700 @endif">
            {{-- Header input --}}
            <input
                class="w-full border-b border-gray-700 bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
                type="text" name="sections[{{ $id }}][header]" value="{{ $header }}" placeholder="Header..." />

            <x-customize-menu>
                <x-customize-menu.text-buttons />
                <x-customize-menu.section-buttons />
            </x-customize-menu>

            {{-- Body input --}}
            <textarea
                class="block min-h-[84px] w-full bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
                name="sections[{{ $id }}][body]" placeholder="Body...">{{ $body }}</textarea>
        </div>
    </div>
</div>