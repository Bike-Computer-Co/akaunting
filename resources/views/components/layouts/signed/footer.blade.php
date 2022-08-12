@stack('footer_start')

<footer class="footer">
    <div class="flex flex-col sm:flex-row items-center justify-center mt-10 lg:mt-20 py-7 text-sm font-light">
        <div>
            <a href="{{ trans('footer.link') }}" target="_blank">
                {{ trans('footer.powered') }}
            </a>
        </div>
    </div>
</footer>

@stack('footer_end')
