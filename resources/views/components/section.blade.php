@php
$error = $errors->has("sections.$id.slug")
|| $errors->has("sections.$id.header")
|| $errors->has("sections.$id.body");
@endphp

<div class="flex flex-col" id="section{{ $id }}">
    <x-input-error for="sections.{{ $id }}.slug" />
    <x-input-error for="sections.{{ $id }}.header" />
    <x-input-error for="sections.{{ $id }}.body" />

    <div class="relative flex">
        <div class="w-full border @if($error) border-red-600 @else border-gray-500 @endif">
            <input
                class="w-full border-b border-gray-500 bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
                type="text" name="sections[{{ $id }}][header]" value="{{ $header }}" placeholder="Header..." />
            <textarea
                class="block min-h-[84px] w-full bg-slate-900 p-3 placeholder-gray-600 focus:placeholder-transparent focus:outline-none"
                name="sections[{{ $id }}][body]" placeholder="Body...">{{ $body }}</textarea>
        </div>
        <div class="absolute -left-8 flex h-full w-8 flex-col text-lg">
            <button class="h-full hover:bg-gray-50 hover:bg-opacity-10" id="delete" type="button"
                onclick="deleteSection({{ $id }})">
                ×
            </button>
            <button class="h-full hover:bg-gray-50 hover:bg-opacity-10" id="up" type="button"
                onclick="moveUpSection({{ $id }})">
                ↑
            </button>
            <button class="h-full hover:bg-gray-50 hover:bg-opacity-10" id="down" type="button"
                onclick="moveDownSection({{ $id }})">
                ↓
            </button>
            <button class="h-full hover:bg-gray-50 hover:bg-opacity-10" id="add" type="button"
                onclick="addSection({{ $id }})">
                +
            </button>
        </div>
    </div>
</div>