<footer>
    <div class="container">
        <div class="ft-flex">
            <a href="{{base_url_lang()}}" title="{{setting()->trans('seo_title')}}" class="ft-logo"><img src="{{public_logo()}}"
                                                     alt="{{setting()->trans('seo_title')}}"> </a>
            <div class="ft-social flex-center-center">
                <a href="{{setting('facebook')}}" title="Facebook" target="_blank" class="fab fa-facebook-f"></a>
                <a href="{{setting('linkedin')}}" title="Linkedin" target="_blank" class="fab fa-linkedin-in"></a>
                <a href="{{setting('instagram')}}" title="Instagram" target="_blank" class="fab fa-instagram"></a>
                <a href="{{setting('twitter')}}" title="Twitter" target="_blank" class="fab fa-twitter"></a>
            </div>
            <span class="copyright">{{setting('Copyright')}}</span>
        </div>
    </div>
</footer>
