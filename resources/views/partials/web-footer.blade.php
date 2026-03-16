<footer class="footer">
    <div class="container footer-inner">

        <div class="footer-main">
            <p class="footer-text">
                © {{ date('Y') }} {{ setting('site_name', 'Community Blog') }}. All rights reserved.

                @if(setting('footer_text'))
                — {{ setting('footer_text') }}
                @endif
            </p>
        </div>

        <div class="footer-powered">
            <a href="https://brndnglb.com" target="_blank" rel="noopener noreferrer">
                Powered by <strong>brndng.</strong>
            </a>
        </div>

    </div>
</footer>