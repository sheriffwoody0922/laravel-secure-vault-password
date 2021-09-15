<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>{{ __('pwa-index.title') }}</title>

        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"/>
        <meta name="format-detection" content="telephone=no"/>

        <link rel="manifest" href="{{ asset('manifest.json') }}" defer="defer"/>

        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="apple-mobile-web-app-title" content="Nitsnet Password Manager"/>
        <meta name="apple-mobile-web-app-status-bar-style" content="white-translucent">
        <meta name="mobile-web-app-capable" content="yes"/>
        <meta name="application-name" content="Nitsnet Password Manager"/>
        <meta name="theme-color" content="white"/>
        <meta name="msapplication-TileColor" content="white"/>
        <meta name="msapplication-TileImage" content="{{ asset('build/images/logo.svg') }}"/>

        <link rel="apple-touch-icon" sizes="512x512" href="{{ asset('build/images/logo.svg') }}"/>
        <link rel="icon" sizes="512x512" href="{{ asset('build/images/logo.svg') }}"/>

        @include ('domains.pwa.styles')
    </head>

    <body>
        <div id="js-pwdmngr-modal" class="pwdmngr-modal">
            <div class="pwdmngr-modal__inner">
                <header id="js-pwdmngr-header" class="pwdmngr-modal__header">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><defs><style>.cls-1{fill:#fff}.cls-2{fill:#717172}</style></defs><circle cx="40" cy="37.82" r="36.59" class="cls-1"/><path d="M62.24 54.91H17.76A1.91 1.91 0 0 1 15.88 53V20.46a1.92 1.92 0 0 1 1.88-2h44.48a1.92 1.92 0 0 1 1.88 2V53a1.91 1.91 0 0 1-1.88 1.91ZM17.76 19.28a1.16 1.16 0 0 0-1.13 1.18V53a1.15 1.15 0 0 0 1.13 1.17h44.48A1.15 1.15 0 0 0 63.37 53V20.46a1.16 1.16 0 0 0-1.13-1.18Z" class="cls-2"/><path d="M62.24 55.06H17.76a2.07 2.07 0 0 1-2-2.1v-32.5a2.07 2.07 0 0 1 2-2.1h44.48a2.07 2.07 0 0 1 2 2.1V53a2.07 2.07 0 0 1-2 2.06ZM17.76 18.65A1.78 1.78 0 0 0 16 20.46V53a1.78 1.78 0 0 0 1.74 1.81h44.5A1.78 1.78 0 0 0 64 53V20.46a1.78 1.78 0 0 0-1.74-1.81Zm44.48 35.63H17.76A1.3 1.3 0 0 1 16.49 53V20.46a1.3 1.3 0 0 1 1.27-1.32h44.48a1.3 1.3 0 0 1 1.27 1.32V53a1.3 1.3 0 0 1-1.27 1.28ZM17.76 19.43a1 1 0 0 0-1 1V53a1 1 0 0 0 1 1h44.48a1 1 0 0 0 1-1V20.46a1 1 0 0 0-1-1Z" class="cls-2"/><path d="M16.25 22.94h47.49v.75H16.25z" class="cls-2"/><path d="M63.89 23.84H16.11v-1h47.78Zm-47.49-.29h47.2v-.47H16.4Zm3.33-2.38a.79.79 0 1 1-.79-.79.79.79 0 0 1 .79.79Zm2.36 0a.79.79 0 0 1-1.58 0 .79.79 0 0 1 1.58 0Zm2.37 0a.79.79 0 1 1-.79-.79.79.79 0 0 1 .79.79Zm2.81 14.47h3.88v3.88h-3.88zm7.19 0h3.88v3.88h-3.88zm7.2 0h3.88v3.88h-3.88zm7.19 0h3.88v3.88h-3.88z" class="cls-2"/><path d="M40 .69a37.13 37.13 0 1 0 37.12 37.13A37.17 37.17 0 0 0 40 .69Zm35.82 37.13A35.82 35.82 0 1 1 40 2a35.86 35.86 0 0 1 35.82 35.82Z" class="cls-2"/><circle cx="20.33" cy="62.09" r="16.94" class="cls-1"/><path d="M20.35 79.31A17.54 17.54 0 0 1 6.13 72a17.45 17.45 0 0 1 17-27.42 17.47 17.47 0 0 1-2.82 34.7Zm-.06-33.88A16.42 16.42 0 0 0 7 71.41a16.48 16.48 0 0 0 13.36 6.84A16.41 16.41 0 0 0 23 45.65a17.46 17.46 0 0 0-2.71-.22Z" class="cls-2"/><path fill="#d71920" d="M27.6 54.82a5.78 5.78 0 0 0-9.6 5.86l-6.5 6.5a.54.54 0 0 0-.15.38v3a.52.52 0 0 0 .52.52h3a.51.51 0 0 0 .37-.15l.74-.75a.49.49 0 0 0 .15-.43l-.09-.8 1.11-.1a.51.51 0 0 0 .47-.47l.1-1.11.8.09a.5.5 0 0 0 .41-.12.55.55 0 0 0 .18-.4v-1h1a.52.52 0 0 0 .37-.16l1.35-1.33A5.68 5.68 0 0 0 27.6 63a5.79 5.79 0 0 0 0-8.18Zm-1.49 3.71a1.57 1.57 0 1 1 0-2.22 1.57 1.57 0 0 1 0 2.22Z"/></svg>

                    <h1 class="pwdmngr-modal__title"><a href="#" id="js-pwdmngr-home">{{ __('pwa-index.title') }}</a></h1>

                    <div class="pwdmngr-modal__menu">
                        <a href="#" id="js-pwdmngr-menu">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><defs/><path d="M6 15h12c.553 0 1 .447 1 1v1c0 .553-.447 1-1 1H6c-.553 0-1-.447-1-1v-1c0-.553.447-1 1-1zm-1-4v1c0 .553.447 1 1 1h12c.553 0 1-.447 1-1v-1c0-.553-.447-1-1-1H6c-.553 0-1 .447-1 1zm0-5v1c0 .553.447 1 1 1h12c.553 0 1-.447 1-1V6c0-.553-.447-1-1-1H6c-.553 0-1 .447-1 1z" opacity=".75"/></svg>
                        </a>
                    </div>
                </header>

                <div id="js-pwdmngr-search" class="pwdmngr-modal__box">
                    <input type="search" name="q" value="" class="pwdmngr-modal__input" />
                    <button type="submit" id="js-pwdmngr-search-submit" class="pwdmngr-modal__submit">{{ __('pwa-index.search') }}</button>
                </div>

                <div id="js-pwdmngr-content" class="pwdmngr-modal__content"></div>

                <div id="js-pwdmngr-api-secret" class="pwdmngr-modal__box pwdmngr-modal__hidden">
                    <input type="password" name="api_secret" value="" placeholder="{{ __('pwa-index.api-secret') }}" class="pwdmngr-modal__input" />
                    <button type="submit" id="js-pwdmngr-api-secret-submit" class="pwdmngr-modal__submit">{{ __('pwa-index.send') }}</button>
                </div>

                <div id="js-pwdmngr-config" class="pwdmngr-modal__box pwdmngr-modal__hidden">
                    <input type="password" name="apikey" value="" placeholder="{{ __('pwa-index.api-key') }}" class="pwdmngr-modal__input" />
                    <button type="submit" id="js-pwdmngr-config-submit" class="pwdmngr-modal__submit">{{ __('pwa-index.save') }}</button>
                </div>
            </div>
        </div>

        @include ('domains.pwa.scripts')
    </body>
</html>