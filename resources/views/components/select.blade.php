@php
    if ($name) {
        $sanitizedName = preg_replace('/-/', '_', $name);
    }
@endphp

<div {{$attributes->merge(['class' => ''])}}>
    @if ($labelName)
        <label for="{{$name}}" class="fw-bold" style="color: var(--primary-color);">
            <x-icon type="{{$labelIcon}}"/>
            {{$labelName}}
        </label>
    @endif
    <select class="form-control" id="{{$name}}" name="{{$sanitizedName}}" {{$addons}} {{$isRequired == true ? 'required' : ''}}>
        {{$slot}}
    </select>
</div>