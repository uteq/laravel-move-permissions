<x-move-form.row custom label="{{ $field->name }}" model="{{ $field->model() }}" :required="$field->isRequired()" help-text="{{ $field->getHelpText() }}">

    <x-move-field.select model="{{ $field->store }}"
                         placeholder="{{ $field->placeholder ?? null }}"
                         :settings="$field->settings"
    >
        @foreach (\Spatie\Permission\Models\Role::all() as $role)
            <option value="{{ $role->name }}" @if ($role->name === $field->value) selected @endif>{{ $role->name }}</option>
        @endforeach
    </x-move-field.select>
</x-move-form.row>
