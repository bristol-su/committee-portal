<link rel="stylesheet" type="text/css"
      href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
<script>
    window.addEventListener("load", function () {
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": "#237afc"
                },
                "button": {
                    "background": "#fff",
                    "text": "#237afc"
                }
            },
            "theme": "edgeless",
            "content": {
                "message": "We use cookies to ensure that we give you the best experience on our website. If you continue we'll assume that you are happy to receive all cookies on our website.",
                "href": "https://www.bristolsu.org.uk/get_cookie_policy_details"
            },
            "cookie": {
                "domain": "{{config('app.cookie_domain')}}"
            }
        })
    });
</script>
