<script defer src="https://europa.eu/webtools/load.js" type="text/javascript"></script>
<script>
    var cl = document.querySelector('html').classList;
    cl.remove('no-js');
    cl.add('has-js');
</script>
@if(App::environment('production'))
<script type="application/json">{"utility":"analytics","siteID":"599","sitePath":["creative-europe-media-database.eacea.ec.europa.eu"],"is404":false,"is403":false,"instance":"ec.europa.eu"}</script>
@endif