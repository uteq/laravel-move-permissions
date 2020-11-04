<x-move-form.row custom label="{{ $field->name }}" model="{{ $field->store }}" :required="$field->isRequired()" help-text="{{ $field->getHelpText() }}">
    <div class="grid grid-cols-2 gap-4">
        @foreach ($field->getOptions() as $group => $options)
            <div>
                <h3 class="text-lg font-bold">{{ ucfirst($group) }}</h3>
                @foreach ($options as $option)
                    <label class="w-full block mb-2 last:mb-0">
                        <x-move-field.checkbox
                            model="{{ $field->store }}.{{ $option->id }}"
                            :value="$option->name"
                        ></x-move-field.checkbox>
                        <span class="pl-2">{{ $option->name }}</span>
                    </label>
                @endforeach
            </div>
        @endforeach
    </div>
</x-move-form.row>
