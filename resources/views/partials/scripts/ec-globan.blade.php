@if(App::environment('production') || App::environment('acceptance'))
<script>
    window.onload = (event) => {
        $wt.render("ec-globan", {
            utility: "globan",
            lang: "en",
            theme: "light",
            logo: true,
            link: true,
            mode: false,
            zindex : 40
        });
    };
</script>
@endif