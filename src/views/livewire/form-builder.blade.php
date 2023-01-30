<div>
    <form wire:submit.prevent="submit">
        @foreach ($formBuilder as $builder)
            <div class="form-group">
                <label for="password" class="form-label">
                    {{ $builder['label'] }}
                    @if (array_key_exists("required", $builder['options']) && $builder['options']['required'])
                        <span class="text-danger">*</span>
                    @endif
                </label>
                @if ($builder['type'] == 'select')
                    <select class="{{ $builder['class'] }}" wire:model.debounce.50ms="form.{{ $builder['model'] }}">
                        @foreach ($builder['choices'] as $choice)
                            <option value="{{ $choice['value'] }}">{{ $choice['name'] }}</option>
                        @endforeach
                    </select>
                @elseif ($builder['type'] == 'radio')
                    @foreach($builder['choices'] as $choice)
                        <div class="form-check">
                            <input
                                class="form-check-input {{ $builder['class'] }}"
                                type="radio"
                                wire:model.debounce.50ms="form.{{ $builder['model'] }}"
                                id="form.{{ $builder['model'] }}-{{ $choice['value'] }}"
                                value="{{ $choice['value'] }}"
                            >
                            <label
                                class="form-check-label"
                                for="form.{{ $builder['model'] }}-{{ $choice['value'] }}"
                            >
                                {{ $choice['name'] }}
                            </label>
                        </div>
                    @endforeach
                @elseif ($builder['type'] == 'check')
                    <div>
                        @foreach($builder['choices'] as $choice)
                            <input
                                type="checkbox"
                                class="form-check-input {{ $builder['class'] }}"
                                id="form.{{ $builder['model'] }}-{{ $choice['value'] }}"
                                wire:model.debounce.50ms="form.{{ $builder['model'] }}"
                                value="{{ $choice['value'] }}"
                            >
                            <label
                                for="form.{{ $builder['model'] }}-{{ $choice['value'] }}"
                                class="form-check-label"
                            >
                                {{ $choice['name'] }}
                            </label>
                            <br>
                        @endforeach
                    </div>
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
