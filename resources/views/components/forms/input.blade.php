<div {{ $attributes->merge(['class' => 'form-group row']) }}>

    <label for="{{ $id }}" class="col-sm-2 col-form-label">{{ $label }}</label>
    <div class="col-md-10">
        <input
        type="{{ $type }}"
        class="form-control @error($name) is-invalid @enderror"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $label }}"
        @if( $value !== null && $value !== "" )
            value="{{ $value }}"
        @else
            value="{{ old($name) }}"
        @endif

        {{ $isRequired ? 'required' : '' }} >

    {{-- @if($hintText)
        <small class="form-text text-muted">{{ $hintText }}</small>
    @endif --}}

    {{-- Dengan Bantuan Error Bag dari Laravel --}}
    @error($name)
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
    </div>
</div>