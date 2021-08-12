<template>
    <div class="lg:w-8/12 m-auto">
        <div id="canvas">

        </div>
    </div>
</template>
<script>
import P5 from 'p5';
import Mappa from 'mappa-mundi';

export default {
    data: function () {
        return {
            events: []
        }
    },
    mounted() {
        const script = (P5) => {
            const options = {
                lat: 0,
                lng: 0,
                zoom: 4,
                style: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png'
            }
            const mappa = new Mappa('Leaflet');
            let myMap;
            let canvas;

            P5.preload = () => {
               axios.get('/api/world-map-events', {}).then(({data}) => {
                    if (data.data.length) {
                        this.events.push(...data.data);
                    }
                });
            }
            // These are your typical setup() and draw() methods
            P5.setup = ( ) => {
                canvas = P5.createCanvas(window.innerWidth / 12 * 8, window.innerHeight);
                myMap = mappa.tileMap(options);
                myMap.overlay(canvas);


            };
            P5.draw = ( ) => {
                P5.clear();
                P5.ellipse(P5.mouseX, P5.mouseY, 40, 40);

                for (let event of this.events){
                    const pix = myMap.latLngToPixel(Number(event['latitude']),Number(event['longitude']));
                    P5.ellipse(pix.x,pix.y,10);
                    P5.text(event["title"],pix.x+10,pix.y+5);
                }

            };
        }    // Attach the canvas to the div
        const p5canvas = new P5(script, 'canvas');

        // const worldMap = P5 => {
        //     // Options for map
        //     const options = {
        //         lat: 0,
        //         lng: 0,
        //         zoom: 4,
        //         style: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png'
        //     }
        //     const mappa = new Mappa('Leaflet');
        //     let myMap
        //     let canvas
        //
        //     P5.setup = (mappa) => {
        //         canvas = P5.createCanvas(640, 580).parent('canvasContainer');
        //         myMap = mappa.tileMap(options);
        //         myMap.overlay(canvas);
        //     };
        //     P5.draw= () =>{
        //         P5.clear();
        //     };
        // }
        // const worldMapCanvas = new P5(worldMap, 'canvas');

    },
    methods: {
        mapData() {

        },
    }
}
</script>

