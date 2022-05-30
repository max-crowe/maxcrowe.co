<style>
#header {
    position: relative;
    background-image: radial-gradient(rgba(255, 255, 255, 0.5) 10%, #fff 70%);
    height: 600px;
}

#header-bg {
    position: absolute;
    height: 100%;
    width: 100%;
    z-index: -2;
    background-size: cover;
    background-repeat: no-repeat;
    background-position-x: center;
}

@media (min-width: 1024px) {
    #header-bg {
        background-image: url("{{ asset('img/background_large.jpg') }}");
    }
}

@media (max-width: 1023px), (max-width: 767px) and (orientation: landscape) {
    #header-bg {
        background-image: url("{{ asset('img/background_landscape.jpg') }}");
    }
}

@media (max-width: 900px) and (orientation: landscape) {
    #header {
        height: 380px;
    }
}

@media (max-width: 500px) {
    #header {
        height: 420px;
    }

    #header-bg {
        background-image: url("{{ asset('img/background_portrait.jpg') }}");
    }
}
</style>
