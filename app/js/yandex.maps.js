/**
 * Script to create yandex maps element
 *
 * @author serg
 */

ymaps.ready(init);

var myMap,
    myPlacemark;

function init() {
    myMap = new ymaps.Map(
        "mapId", {
            center: [19.082178,20.455886],
            zoom: 1
        }
    );
}