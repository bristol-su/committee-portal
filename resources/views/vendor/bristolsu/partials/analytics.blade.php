@if(config('app.analytics.enabled', false))
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133673398999-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', '{{config('app.analytics.UA')}}');
</script>
@endif