let datosProcesados = [];
console.log("Cargando datos y eventos...");

window.onload = function () {
    cargarDatosYEventos();
};

function obtenerDatosComunidad(id) {
    const comunidadAutonoma = datosProcesados.find(comunidad =>
        comunidad.code === id || comunidad.label.normalize("NFD").replace(/[\u0300-\u036f]/g, "") === id
    );

    if (comunidadAutonoma) {
        return comunidadAutonoma;
    } else {
        console.error("Error: No se encontró la comunidad autónoma con el código:", id);
        return null;
    }
}

function cargarDatosYEventos() {
    fetch('views/landingpage/arbol.json')
        .then(response => response.json())
        .then(data => {
            datosProcesados = data;
            console.log("Datos cargados:", datosProcesados);

            const tuSVG = document.getElementById("tuSVG");
            if (tuSVG) {
                tuSVG.addEventListener("click", function (event) {
                    const path = event.target.closest("path");
                    if (path) {
                        const pathId = path.getAttribute("id");
                        const comunidadAutonoma = obtenerDatosComunidad(pathId);

                        if (comunidadAutonoma) {
                            abrirModal(comunidadAutonoma);
                        } else {
                            console.error("Error: comunidadAutonoma es undefined.");
                        }
                    } else {
                        console.error("Error: No se encontró la ruta ('path') dentro del SVG.");
                    }
                });
            } else {
                console.error("Error: No se encontró el elemento con ID 'tuSVG'.");
            }
        })
        .catch(error => {
            console.error('Error al cargar el archivo JSON: ' + error);
        });
}

function abrirModal(comunidadAutonoma) {
    const modalTitulo = document.getElementById("modalTitulo");
    const modalLista = document.getElementById("modalLista");

    if (!modalTitulo || !modalLista) {
        console.error("Error: No se encontraron elementos de la modal.");
        return;
    }

    if (!comunidadAutonoma) {
        console.error("Error: comunidadAutonoma es undefined.");
        return;
    }

    console.log("Estructura completa de comunidadAutonoma:", comunidadAutonoma);

    const modal = new bootstrap.Modal(document.getElementById("miModal"));
    modalTitulo.textContent = comunidadAutonoma.label;

    mostrarProvincias(comunidadAutonoma);

    modal.show();
}

function mostrarProvincias(comunidadAutonoma) {
    const modalLista = document.getElementById("modalLista");

    if (!modalLista) {
        console.error("Error: No se encontró la lista de provincias.");
        return;
    }

    if (comunidadAutonoma.provinces) {
        modalLista.innerHTML = comunidadAutonoma.provinces.map(provincia =>
            `<li class="list-group-item provincia" data-provincia='${provincia.label}'><a href="./views/communityList.php?id_comarca=${provincia.code}">${provincia.label}</a></li>`
        ).join('');

        const provinciasItems = document.querySelectorAll('.provincia');
        provinciasItems.forEach(item => {
            item.addEventListener('click', function () {
                const provinciaLabel = this.getAttribute('data-provincia');
                consultarComunidadesPorNombre(provinciaLabel);
            });
        });
    } else {
        modalLista.innerHTML = "No hay información de provincias.";
    }
}

function consultarComunidadesPorNombre(comarcaName) {
    fetch('mapa.php?action=getCommunityByName', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ comarca_name: comarcaName }),
    })
        .then(response => response.json())
        .then(data => mostrarComunidades(data))
        .catch(error => console.error('Error al consultar comunidades por nombre:', error));
}

function mostrarComunidades(comunidades) {
    const modalLista = document.getElementById("modalLista");

    if (!modalLista) {
        console.error("Error: No se encontró la lista de comunidades.");
        return;
    }

    try {
        const jsonData = JSON.parse(comunidades);

        if (jsonData.error) {
            // Mostrar el error en lugar de los datos
            console.error('Error al consultar comunidades por nombre:', jsonData.error);
            modalLista.innerHTML = "Error al consultar comunidades por nombre.";
        } else if (Array.isArray(jsonData)) {
            console.log("Mostrando comunidades:", jsonData);
            modalLista.innerHTML = jsonData.map(comunidad =>
                `<li class="list-group-item">${comunidad}</li>`
            ).join('');
        } else {
            console.log("No hay información de comunidades para esta comarca.");
            modalLista.innerHTML = "No hay información de comunidades para esta comarca.";
        }
    } catch (error) {
        // Manejar errores al analizar JSON
        console.error('Error al analizar la respuesta JSON:', error);
        modalLista.innerHTML = "Error al analizar la respuesta JSON.";
    }
}
