@php
if ($name) {
$sanitizedName = preg_replace('/-/', '_', $name);
}
@endphp

<div class="">
    <label for="{{$name}}" class="fw-medium primary-color">{{ucfirst($labelName)}}</label>
    <div {{$attributes->merge(['class' => 'input-group mb-3'])}}>
        @if ($labelIcon)
        <label for="{{$name}}" class="input-group-text">
            <x-icon type="{{$labelIcon}}" />
        </label>
        @endif
        <input type="{{$type}}" class="form-control" id="{{$name}}" name="{{$sanitizedName}}" value="{{$value}}"
            placeholder="{{$placeholder}}" {{$addons}} {{$isRequired==true ? 'required' : '' }}>

        @if ($tailIcon)
        <x-icon type="{{$tailIcon}} input-group-text" />
        @endif
    </div>
</div>
