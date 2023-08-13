const elements = document.getElementById('banderas');
var language = "indexEspañol";

if (elements) {
    const textosCambioIdioma = document.querySelectorAll("[data-section]");
    async function cambioIdioma(language) {
        const requestJson = await fetch(`../languages/${language}.json`);
        const textos = await requestJson.json();
        for (let i = 0; i < select.options.length; i++) {
            const option = select.options[i];
             const valor = option.value;
             if (textos[valor]) {
        option.innerHTML = textos[valor];
        }
     }

        for (const textosCambioIdiomaVariable of textosCambioIdioma) {
            const secciones = textosCambioIdiomaVariable.dataset.section;
            const valor = textosCambioIdiomaVariable.dataset.value;


            if (textos[secciones] && textos[secciones][valor]) {
                if (textosCambioIdiomaVariable.value) {
                    textosCambioIdiomaVariable.value = textos[secciones][valor];
                }
                textosCambioIdiomaVariable.innerHTML = textos[secciones][valor];
            }
        }
    }

    elements.addEventListener("click", function (e) {
        cambioIdioma(e.target.parentElement.dataset.language);
        language = e.target.parentElement.dataset.language;
    });
} else {
    console.error("El elemento con ID 'banderas' no se encontró.");
}

