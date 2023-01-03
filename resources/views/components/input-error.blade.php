@error($for)
<span {{ $attributes->merge(['class' => 'error text-xs text-red-600 pl-2']) }}>{{ $message }}</span>
@enderror