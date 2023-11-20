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
