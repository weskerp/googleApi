<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
    <style>
        .row2 {
            display: flex;
            flex-direction: row;
            gap: 10px;
            align-items: center;
        }

        h5 {
            min-width: 100px;
        }

        #map {
            margin-bottom: 30px;
        }
        .home{
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 300px;
            max-width: 100vw;
            flex-direction: column;
            padding-left: 50px;
            gap: 30px;
        }
    </style>

    <!-- Botão para abrir o modal -->
    <div class="home">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mapModal">
            ABRIR MAPA
        </button>
        <div>

        <div class="row2 gap-3">
            <div>
                <label for="latitude">Latitude:</label>
                <input type="text" id="latitude" readonly>
            </div>

            <div>
                <label for="longitude">Longitude:</label>
                <input type="text" id="longitude" readonly>
            </div>
        </div>
        <h4>Coordenadas UTM</h4>
        <div class="row2">
            <div>
                <label for="datum">Datum:</label>
                <input type="text" id="datum" readonly>
            </div>

            <div>
                <label for="fuso">Fuso:</label>
                <input type="text" id="fuso" readonly>
            </div>
            <div>
                <label for="x">X:</label>
                <input type="text" id="x" readonly>
            </div>

            <div>
                <label for="y">Y:</label>
                <input type="text" id="y" readonly>
            </div>
        </div>
        <h4>Coordenadas GMS</h4>
        <div class="row2">
            <h5>Latitude:</h5>
            <div>
                <label for="latitudeGraus">Graus:</label>
                <input type="text" id="latitudeGraus" readonly>
            </div>

            <div>
                <label for="latitudeMinutos">Minutos:</label>
                <input type="text" id="latitudeMinutos" readonly>
            </div>
            <div>
                <label for="latitudeSegundos">Segundos:</label>
                <input type="text" id="latitudeSegundos" readonly>
            </div>
        </div>
        <div class="row2">
            <h5>Longitude:</h5>
            <div>
                <label for="longitudeGraus">Graus:</label>
                <input type="text" id="longitudeGraus" readonly>
            </div>

            <div>
                <label for="longitudeMinutos">Minutos:</label>
                <input type="text" id="longitudeMinutos" readonly>
            </div>
            <div>
                <label for="longitudeSegundos">Segundos:</label>
                <input type="text" id="longitudeSegundos" readonly>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="mapModal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Mapa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map" style="height: 400px;"></div>
                    <div class="row2">
                        <div>
                            <label for="latitudeModal">Latitude:</label>
                            <input type="text" id="latitudeModal" readonly>
                        </div>

                        <div>
                            <label for="longitudeModal">Longitude:</label>
                            <input type="text" id="longitudeModal" readonly>
                        </div>
                    </div>
                    <h4>Coordenadas UTM</h4>
                    <div class="row2">
                        <div>
                            <label for="datumModal">Datum:</label>
                            <input type="text" id="datumModal" readonly>
                        </div>

                        <div>
                            <label for="fusoModal">Fuso:</label>
                            <input type="text" id="fusoModal" readonly>
                        </div>
                        <div>
                            <label for="xModal">X:</label>
                            <input type="text" id="xModal" readonly>
                        </div>

                        <div>
                            <label for="yModal">Y:</label>
                            <input type="text" id="yModal" readonly>
                        </div>
                    </div>
                    <h4>Coordenadas GMS</h4>
                    <div class="row2">
                        <h5>Latitude:</h5>
                        <div>
                            <label for="latitudeGrausModal">Graus:</label>
                            <input type="text" id="latitudeGrausModal" readonly>
                        </div>

                        <div>
                            <label for="latitudeMinutosModal">Minutos:</label>
                            <input type="text" id="latitudeMinutosModal" readonly>
                        </div>
                        <div>
                            <label for="latitudeSegundosModal">Segundos:</label>
                            <input type="text" id="latitudeSegundosModal" readonly>
                        </div>
                    </div>
                    <div class="row2">
                        <h5>Longitude:</h5>
                        <div>
                            <label for="longitudeGrausModal">Graus:</label>
                            <input type="text" id="longitudeGrausModal" readonly>
                        </div>

                        <div>
                            <label for="longitudeMinutosModal">Minutos:</label>
                            <input type="text" id="longitudeMinutosModal" readonly>
                        </div>
                        <div>
                            <label for="longitudeSegundosModal">Segundos:</label>
                            <input type="text" id="longitudeSegundosModal" readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="saveCoordinates()">OK</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -19.887726608890095,
                    lng: -43.98125994750702
                },
                zoom: 12
            });

            // Adicione um ouvinte de clique ao mapa
            google.maps.event.addListener(map, 'click', function(event) {
                // Obtém as coordenadas do ponto clicado
                var clickedLatLng = event.latLng;

                // Exibe as coordenadas nos campos de input
                document.getElementById('latitudeModal').value = clickedLatLng.lat();
                document.getElementById('longitudeModal').value = clickedLatLng.lng();

                // Calcula as coordenadas UTM
                var utmCoordinates = convertLatLngToUTM(clickedLatLng);
                document.getElementById('datumModal').value = 'WGS84';
                document.getElementById('fusoModal').value = utmCoordinates.fuso;
                document.getElementById('xModal').value = utmCoordinates.x;
                document.getElementById('yModal').value = utmCoordinates.y;

                // Calcula as coordenadas GMS
                var gmsCoordinates = convertLatLngToGMS(clickedLatLng);
                document.getElementById('latitudeGrausModal').value = gmsCoordinates.latitude.graus;
                document.getElementById('latitudeMinutosModal').value = gmsCoordinates.latitude.minutos;
                document.getElementById('latitudeSegundosModal').value = gmsCoordinates.latitude.segundos;
                document.getElementById('longitudeGrausModal').value = gmsCoordinates.longitude.graus;
                document.getElementById('longitudeMinutosModal').value = gmsCoordinates.longitude.minutos;
                document.getElementById('longitudeSegundosModal').value = gmsCoordinates.longitude.segundos;
            });
        }

        function initializeMap() {
            if (!map) {
                // Chama initMap se o mapa ainda não estiver inicializado
                initMap();
            } else {
                // Limpa o mapa se já estiver inicializado
                map = null;
            }
        }

        // Função para converter coordenadas latLng para UTM
        function convertLatLngToUTM(latLng) {
            var latitude = latLng.lat();
            var longitude = latLng.lng();

            // Determina o fuso UTM
            var utmZone = Math.floor((longitude + 180) / 6) + 1;

            // Converte latitude e longitude para radianos
            var latRad = latitude * Math.PI / 180;
            var lonRad = longitude * Math.PI / 180;

            // Parâmetros de projeção UTM
            var k0 = 0.9996; // Fator de escala
            var a = 6378137; // Raio equatorial da Terra
            var f = 1 / 298.257223563; // Achatamento

            // Cálculos para projeção UTM
            var e2 = 2 * f - f * f;
            var N = a / Math.sqrt(1 - e2 * Math.sin(latRad) * Math.sin(latRad));
            var T = Math.tan(latRad) * Math.tan(latRad);
            var C = e2 * Math.cos(latRad) * Math.cos(latRad);
            var A = Math.cos(latRad) * (lonRad - (utmZone * 6 - 183) * Math.PI / 180);
            var M = a * ((1 - e2 / 4 - 3 * e2 * e2 / 64 - 5 * e2 * e2 * e2 / 256) * latRad -
                (3 * e2 / 8 + 3 * e2 * e2 / 32 + 45 * e2 * e2 * e2 / 1024) * Math.sin(2 * latRad) +
                (15 * e2 * e2 / 256 + 45 * e2 * e2 * e2 / 1024) * Math.sin(4 * latRad) -
                (35 * e2 * e2 * e2 / 3072) * Math.sin(6 * latRad));

            // Coordenadas UTM
            var UTMEasting = (k0 * N * (A + (1 - T + C) * A * A * A / 6 + (5 - 18 * T + T * T + 72 * C - 58 * e2) * A * A * A * A * A / 120) + 500000.0);
            var UTMNorthing = (k0 * (M + N * Math.tan(latRad) * (A * A / 2 + (5 - T + 9 * C + 4 * C * C) * A * A * A * A / 24 + (61 - 58 * T + T * T + 600 * C - 330 * e2) * A * A * A * A * A * A / 720)));

            // Hemisfério
            var hemisphere = (latitude < 0) ? 'S' : 'N';

            return {
                fuso: utmZone,
                x: UTMEasting,
                y: UTMNorthing,
                hemisferio: hemisphere
            };
        }

        // Função para converter coordenadas latLng para GMS
        function convertLatLngToGMS(latLng) {
            var latitude = latLng.lat();
            var longitude = latLng.lng();

            function convertDecimalToGMS(decimal) {
                var degrees = Math.floor(decimal);
                var minutesWithDecimal = (decimal - degrees) * 60;
                var minutes = Math.floor(minutesWithDecimal);
                var seconds = Math.round((minutesWithDecimal - minutes) * 60);

                return {
                    degrees: degrees,
                    minutes: minutes,
                    seconds: seconds
                };
            }

            var latitudeGMS = convertDecimalToGMS(Math.abs(latitude));
            var longitudeGMS = convertDecimalToGMS(Math.abs(longitude));

            return {
                latitude: {
                    graus: latitude >= 0 ? latitudeGMS.degrees + '°N' : latitudeGMS.degrees + '°S',
                    minutos: latitudeGMS.minutes + "'",
                    segundos: latitudeGMS.seconds + '"'
                },
                longitude: {
                    graus: longitude >= 0 ? longitudeGMS.degrees + '°E' : longitudeGMS.degrees + '°W',
                    minutos: longitudeGMS.minutes + "'",
                    segundos: longitudeGMS.seconds + '"'
                }
            };
        }

        function saveCoordinates() {
            document.getElementById('latitude').value = document.getElementById('latitudeModal').value;
            document.getElementById('longitude').value = document.getElementById('longitudeModal').value;
            document.getElementById('datum').value = document.getElementById('datumModal').value;
            document.getElementById('fuso').value = document.getElementById('fusoModal').value;
            document.getElementById('x').value = document.getElementById('xModal').value;
            document.getElementById('y').value = document.getElementById('yModal').value;
            document.getElementById('latitudeGraus').value = document.getElementById('latitudeGrausModal').value;
            document.getElementById('latitudeMinutos').value = document.getElementById('latitudeMinutosModal').value;
            document.getElementById('latitudeSegundos').value = document.getElementById('latitudeSegundosModal').value;
            document.getElementById('longitudeGraus').value = document.getElementById('longitudeGrausModal').value;
            document.getElementById('longitudeMinutos').value = document.getElementById('longitudeMinutosModal').value;
            document.getElementById('longitudeSegundos').value = document.getElementById('longitudeSegundosModal').value;
            $('#mapModal').modal('hide');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>