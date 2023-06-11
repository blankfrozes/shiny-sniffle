<div class="flex items-center justify-center {{ $class }}">
    <label class="w-full">
        <span class="mb-1 text-xs text-gray-700 sm:text-sm md:text-lg">{{ $label }}</span>
        <input x-data x-ref="input" x-init="flatpickr($refs.input, {})" type="text" readonly="readonly"
            wire:model.defer="{{ $name }}" placeholder="{{ $placeholder }}"
            onchange="this.dispatchEvent(new InputEvent('input'))" class="block w-full px-2 py-1 form-input" />
        @error($name)
            <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </label>
</div>
