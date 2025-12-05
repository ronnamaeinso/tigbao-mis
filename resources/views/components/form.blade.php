<form {{$attributes->merge(['class' => 'w-100'])}}>
    @csrf
    {{$slot}}
</form>