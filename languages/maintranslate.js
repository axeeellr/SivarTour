const elements = document.getElementById("banderas");

const textosCambioIdioma = document.querySelectorAll("[data-section]");

const cambioIdioma = async language => {
    const requestJson = await fetch(`./languages/${language}.json`);
    const textos = await requestJson.json();

    for (const textosCambioIdiomaVariable of textosCambioIdioma) {
        const secciones = textosCambioIdiomaVariable.dataset.section;
        const valor = textosCambioIdiomaVariable.dataset.value;
        
        if (textosCambioIdiomaVariable.value ) {
            textosCambioIdiomaVariable.value = textos[secciones][valor];
        }

        textosCambioIdiomaVariable.innerHTML = textos[secciones][valor];
    }
};

elements.addEventListener("click", function (e) {
    console.log("si");
    cambioIdioma(e.target.parentElement.dataset.language);
});

