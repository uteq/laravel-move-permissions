<div class="grid grid-cols-2 gap-4">
@foreach ($field->getOptions() as $group => $options)
    <div>
        <h3 class="text-lg font-bold">{{ ucfirst($group) }}</h3>
        @foreach ($options as $option)
            <div class="flex">
                @if ($field->resource->permissions->contains('name', $option->name))
                    <x-ri-checkbox-blank-circle-fill title="{{ __($option->name) }}" class="h-4 w-4 mr-1 mt-1 last:mr-0 text-green-500" />
                @else
                    <x-ri-checkbox-blank-circle-fill title="{{ __($option->name) }}" class="h-4 w-4 mr-1 mt-1 last:mr-0 text-red-500" />
                @endif
                <span class="pl-2">{{ ucfirst($option->name) }}</span>
            </div>
        @endforeach
    </div>
@endforeach
</div>
