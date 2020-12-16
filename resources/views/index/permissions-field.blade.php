<div class="flex text-wrap" style="max-width: 600px;">

@foreach ($field->getOptions()->flatten() as $option)
    @if ($field->resource->permissions->contains('name', $option->name))

        <svg class="fill-current h-4 w-4 mr-1 mt-1 last:mr-0 text-green-500" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" title="{{ __($option->name) }}">
            <path fill-rule="evenodd" d="M512 512m-426.666667 0a426.666667 426.666667 0 1 0 853.333334 0 426.666667 426.666667 0 1 0-853.333334 0Z"  />
        </svg>
    @else
        <svg class="fill-current h-4 w-4 mr-1 mt-1 last:mr-0 text-red-500" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" title="{{ __($option->name) }}">
            <path fill-rule="evenodd" d="M512 512m-426.666667 0a426.666667 426.666667 0 1 0 853.333334 0 426.666667 426.666667 0 1 0-853.333334 0Z"  />
        </svg>
    @endif
@endforeach
</div>
