<div class="form-group row">
    <label for="{{ $id }}" class="col-md-4 col-form-label">{{ $label }}</label>
    <div class="col-md-8">
        <div class="input-group">
            <input
                id="{{ $id }}"
                type="{{ $type }}"
                name="{{ $name }}"
                class="form-control"
                {{ $required ? 'required' : '' }}
                @if(!empty($pattern)) pattern="{{ $pattern }}" @endif
                @if(!empty($title)) title="{{ $title }}" @endif
                autocomplete="off"
            >
            @if($type === 'password')
                <div class="input-group-append">
                    <span class="fa fa-eye o_little_eye input-group-text" aria-hidden="true" style="cursor: pointer;" onclick="ShowPassword('{{ $id }}')"></span>
                </div>
            @endif
        </div>
    </div>
</div>
