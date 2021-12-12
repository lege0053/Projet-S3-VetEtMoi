<?php
declare(strict_types=1);

class Map
{
    /**
     * Ajoute-les urls js et les liens nécessaire à l’utilisation de MapBox.
     * @param WebPage $page
     */
    public static function addHeader(WebPage $page)
    {
        $page->appendToHead(
            <<<HTML
                <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
                <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
                <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.js"></script>
                <link
                    rel="stylesheet"
                    href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.css"
                    type="text/css"
                />
            HTML
        );
    }

    /**
     * Ajoute une MapBox dans une div avec comme id "map".
     * @param WebPage $page La WebPage qui doit contenir la carte.
     * @param string $userId L'id du client chez qui le vétérinaire souhaite se déplacer.
     * @param string $style Le style css de la div qui contient la carte.
     * @throws Exception
     */
    public static function displayMap(WebPage $page, string $userId, string $style='d-flex flex-grow-1')
    {
        self::addHeader($page);

        $req=MyPDO::getInstance()->prepare(<<<SQL
        SELECT *
        FROM Users
        WHERE userId=?
        SQL);
        $req->execute([$userId]);
        $user=$req->fetch();
        $addr=$user['rue']." ".$user['city'];

        $page->appendContent(
            <<<HTML
            <div id="map" class='$style'></div>
            <script>
                    mapboxgl.accessToken = 'pk.eyJ1IjoidGhpYmF1dHAxMSIsImEiOiJja3gzN2JsNjYwa3M3MnVvMW9zemNwdm1hIn0.NhkKMkshg3ZSlH4lJEZUiA';
                    const map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/mapbox/streets-v11',
                    zoom: 9
                    });
                    
                    var geocolateControl=new mapboxgl.GeolocateControl({
                    positionOptions: {
                    enableHighAccuracy: true
                    },
                    trackUserLocation: true,
                    showUserHeading: true
                    });
                    
                    map.addControl(geocolateControl);                    
                    
                    var directions=new MapboxDirections({accessToken: mapboxgl.accessToken});
                    map.addControl(directions);
                   
                    
                    map.on('load', function ()
                    {
                        geocolateControl.trigger();
                        var coord;
                        navigator.geolocation.getCurrentPosition(function (pos)
                        {
                           directions.setOrigin([pos.coords.longitude,pos.coords.latitude]);
                        })
                        var addr = '<?=$addr?>';
                        directions.setDestination(addr);
                    })    
            </script>
            HTML);
    }
}