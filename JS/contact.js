function initMap(){
    //map options
    var options={
        zoom:20,
        center:{lat: 6.608058622735243,  lng:0.476755817898074}
    }

    //new map
    var map=new
    map=new google.maps.Map(document.getElementById('map'),options);

    var maker = new google.maps.Maker({
        position:{lat:6.594584411582559, lng:0.4355105779483452},
        map:map
    });
}
