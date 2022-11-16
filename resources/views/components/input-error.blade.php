@error($for)
<span {{ $attributes->merge(['class' => 'text-xs text-red-600 pl-2']) }}>{{ $message }}</span>
@enderror