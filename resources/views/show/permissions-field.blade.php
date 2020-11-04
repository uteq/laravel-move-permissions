<div class="flex text-wrap" style="max-width: 600px;">
@foreach ($field->getOptions()->flatten() as $option)
    @if ($field->resource->permissions->contains('name', $option->name))
        <x-ri-checkbox-blank-circle-fill title="{{ __($option->name) }}" class="h-2 w-2 mr-1 last:mr-0 text-green-500" />
    @else
        <x-ri-checkbox-blank-circle-fill title="{{ __($option->name) }}" class="h-2 w-2 mr-1 last:mr-0 text-red-500" />
    @endif
@endforeach
</div>
