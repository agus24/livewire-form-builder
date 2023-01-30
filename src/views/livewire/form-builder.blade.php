<div>
    <form wire:submit.prevent="submit">
        @foreach ($formBuilder as $builder)
            <div class="form-group">
                <label for="password" class="form-label">
                    {{ $builder['label'] }}
                    @if (array_key_exists("required", $builder['options']))
                        <span class="text-danger">*</span>
                    @endif
                </label>
                @if ($builder['type'] == 'select')
                    <select class="{{ $builder['class'] }}" wire:model.debounce.50ms="form.{{ $builder['model'] }}">
                        @foreach ($builder['choices'] as $choice)
                            <option value="{{ $choice['value'] }}">{{ $choice['name'] }}</option>
                        @endforeach
                    </select>
                @else
                    <input
                        type="{{ $builder['type'] }}"
                        class="{{ $builder['class'] }}"
                        wire:model.debounce.50ms="form.{{ $builder['model'] }}"
                        @if (array_key_exists("ignored", $builder['options']))
                            {{ $builder['options']['ignored'] ? "wire:ignore" : "" }}
                        @endif

                        @if (array_key_exists("disabled", $builder['options']))
                        {{ $builder['options']['disabled'] ? "disabled" : "" }}
                        @endif

                        @if (array_key_exists("readonly", $builder['options']))
                            {{ $builder['options']['readonly'] ? "readonly" : "" }}
                        @endif
                    >
                @endif
                @error("form.".$builder['model']) <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
        @endforeach
        <div class="form-group">
            <button class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
