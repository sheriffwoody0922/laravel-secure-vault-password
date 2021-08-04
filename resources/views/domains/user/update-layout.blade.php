@extends ('layouts.in')

@section ('body')

<div class="box flex items-center px-5">
    <div class="nav nav-tabs flex-col sm:flex-row justify-center lg:justify-start mr-auto" tab="tablist">
        <a href="javascript:;" class="py-4 sm:mr-8" role="tab">{{ $row->name }}</a>
        <a href="{{ route('user.update', $row->id) }}" class="py-4 sm:mr-8 {{ ($ROUTE === 'user.update') ? 'active' : '' }}" role="tab">{{ __('user-update.data') }}</a>
        <a href="{{ route('user.update.team', $row->id) }}" class="py-4 sm:mr-8 {{ ($ROUTE === 'user.update.team') ? 'active' : '' }}" role="tab">{{ __('user-update.teams') }}</a>
        <a href="{{ route('user.update.app', $row->id) }}" class="py-4 sm:mr-8 {{ ($ROUTE === 'user.update.app') ? 'active' : '' }}" role="tab">{{ __('user-update.apps') }}</a>
    </div>
</div>

<div class="tab-content">
    <div class="tab-pane active" tab="tabpanel">
        @yield('content')
    </div>
</div>

@stop
