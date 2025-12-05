<div {{$attributes->merge(['class' => 'card bg-white shadow-lg rounded'])}}>
    <div class="card-header">
        {{$cardheader ?? ''}}
    </div>
    <div class="card-body {{$cardBodyClass}}">
        {{$slot}}
    </div>
</div>