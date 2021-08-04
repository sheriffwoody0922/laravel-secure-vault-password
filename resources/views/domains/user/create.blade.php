@extends ('layouts.in')

@section ('body')

<div class="box flex items-center px-5">
    <div class="nav nav-tabs flex-col sm:flex-row justify-center lg:justify-start mr-auto" role="tablist">
        <a href="javascript:;" class="py-4 sm:mr-8 active" role="tab">{{ __('user-create.data') }}</a>
        <a href="javascript:;" class="py-4 sm:mr-8" role="tab">{{ __('user-create.teams') }}</a>
    </div>
</div>

<div class="tab-content">
    <div class="tab-pane active" role="tabpanel">
        <form method="post">
            <input type="hidden" name="_action" value="create" />

            <div class="box p-5 mt-5">
                <div class="p-2">
                    <label for="user-name" class="form-label">{{ __('user-create.name') }}</label>
                    <input type="text" name="name" class="form-control form-control-lg" id="user-name" value="{{ $REQUEST->input('name') }}" required>
                </div>

                <div class="p-2">
                    <label for="user-email" class="form-label">{{ __('user-create.email') }}</label>
                    <input type="email" name="email" class="form-control form-control-lg" id="user-email" value="{{ $REQUEST->input('email') }}" required>
                </div>

                @if ($certificate_enabled)

                <div class="p-2">
                    <label for="user-certificate" class="form-label">{{ __('user-create.certificate') }}</label>
                    <input type="text" name="certificate" class="form-control form-control-lg" id="user-certificate" value="{{ $REQUEST->input('certificate') }}">
                </div>

                @endif

                <div class="p-2">
                    <label for="user-password" class="form-label">{{ __('user-create.password') }}</label>

                    <div class="input-group">
                        <input type="password" name="password" class="form-control form-control-lg" id="user-password" value="{{ $REQUEST->input('password') }}" autocomplete="off" />

                        <button type="button" class="input-group-text input-group-text-lg tooltip" data-tippy-content="{{ __('common.copied') }}" title="{{ __('common.copy') }}" data-copy data-copy-target="#user-password" tabindex="-1">@icon('clipboard', 'w-5 h-5')</button>
                        <button type="button" class="input-group-text input-group-text-lg" title="{{ __('common.show') }}" data-password-show="#user-password" tabindex="-1">@icon('eye', 'w-5 h-5')</button>
                        <button type="button" class="input-group-text input-group-text-lg" title="{{ __('common.generate') }}" data-password-generate="#user-password" tabindex="-1">@icon('refresh-cw', 'w-5 h-5')</button>
                     </div>
                </div>

                @if ($certificate_enabled)

                <div class="p-2">
                    <div class="form-check">
                        <input type="hidden" name="password_enabled" value="">
                        <input type="checkbox" name="password_enabled" value="1" class="form-check-switch" id="user-password_enabled" {{ $REQUEST->input('password_enabled') ? 'checked' : '' }}>
                        <label for="user-password_enabled" class="form-check-label">{{ __('user-create.password_enabled') }}</label>
                    </div>
                </div>

                @endif
            </div>

            <div class="box p-5 mt-5">
                <div class="p-2">
                    <div class="form-check">
                        <input type="hidden" name="readonly" value="">
                        <input type="checkbox" name="readonly" value="1" class="form-check-switch" id="user-readonly" {{ $REQUEST->input('readonly') ? 'checked' : '' }}>
                        <label for="user-readonly" class="form-check-label">{{ __('user-create.readonly') }}</label>
                    </div>
                </div>

                <div class="p-2">
                    <div class="form-check">
                        <input type="hidden" name="admin" value="">
                        <input type="checkbox" name="admin" value="1" class="form-check-switch" id="user-admin" {{ $REQUEST->input('admin') ? 'checked' : '' }}>
                        <label for="user-admin" class="form-check-label">{{ __('user-create.admin') }}</label>
                    </div>
                </div>

                <div class="p-2">
                    <div class="form-check">
                        <input type="hidden" name="enabled" value="">
                        <input type="checkbox" name="enabled" value="1" class="form-check-switch" id="user-enabled" {{ $REQUEST->input('enabled') ? 'checked' : '' }}>
                        <label for="user-enabled" class="form-check-label">{{ __('user-create.enabled') }}</label>
                    </div>
                </div>
            </div>

            <div class="box p-5 mt-5">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">{{ __('user-create.save') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

@stop
