<!DOCTYPE html>
<html lang="en">

<head>
    <script src="{{asset('js/maps.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps.api_key')}}&callback=initMap" async defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{asset('css/maps.css')}}" >
</head>

<body>
    <!-- Botão para abrir o modal -->
    <div class="home">
        <div class="container-map">
            <div class="map-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mapModal">
                    ABRIR MAPA
                </button>
            </div>
            <div class="content-map">
                <div class="row2">
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
                <div class="modal-footer" style="justify-content: space-between;">
                    <p style="align-self: left;">clique em um ponto no mapa para selecionar as coordenadas!</p>
                    <div class="buttons">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="saveCoordinates()">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>