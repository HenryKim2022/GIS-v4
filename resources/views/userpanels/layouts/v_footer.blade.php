<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
        <div
            class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                <span class="footer-text">
                    © {{ env('APP_YEAR') == date('Y') ? env('APP_YEAR') :  env('APP_YEAR') . '-' . date('Y') }}
                </span>
                , made with <span class="text-danger"><i
                        class="tf-icons mdi mdi-heart"></i></span> by
                <a href="{{ env('APP_URL') }}" target="_blank"
                    class="footer-link fw-medium">{{ env('APP_NAME') }}</a>
            </div>
            <div class="d-none d-lg-inline-block">
                <div
                    class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP
                    v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- CST: WHEN MODAL ACTIVE --}}
<div class="content-backdrop fade"></div>
