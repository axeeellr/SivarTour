let uploadButton = document.getElementById("upload-button");
let chosenImage = document.getElementById("chosen-image");
let fileName = document.getElementById("file-name");
let container = document.querySelector(".newplace__img");
let error = document.getElementById("error");
let imageDisplay = document.getElementById("image-display");

const fileHandler = (file, name, type) => {
    if (type.split("/")[0] !== "image") {
        //File Type Error
        error.innerText = "Please upload an image file";
        return false;
    }
    error.innerText = "";
    let reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onloadend = () => {
        //image and file name
        let imageContainer = document.createElement("figure");
        let img = document.createElement("img");
        img.src = reader.result;
        imageContainer.appendChild(img);
        imageContainer.innerHTML += `<figcaption>${name}</figcaption>`;
        imageDisplay.appendChild(imageContainer);
    };
};

//Upload Button
uploadButton.addEventListener("change", () => {
    imageDisplay.innerHTML = "";
    const file = uploadButton.files[0]; // Accede al primer archivo cargado
    if (file) {
        fileHandler(file, file.name, file.type);
    }
});


container.addEventListener(
    "dragenter",
    (e) => {
        e.preventDefault();
        e.stopPropagation();
        container.classList.add("activee");
    },
    false
);

container.addEventListener(
    "dragleave",
    (e) => {
        e.preventDefault();
        e.stopPropagation();
        container.classList.remove("activee");
    },
    false
);

container.addEventListener(
    "dragover",
    (e) => {
        e.preventDefault();
        e.stopPropagation();
        container.classList.add("activee");
    },
    false
);

container.addEventListener(
    "drop",
    (e) => {
        e.preventDefault();
        e.stopPropagation();
        container.classList.remove("activee");
        let draggedData = e.dataTransfer;
        let files = draggedData.files;
        imageDisplay.innerHTML = "";
        Array.from(files).forEach((file) => {
            fileHandler(file, file.name, file.type);
        });
    },
    false
);

window.onload = () => {
    error.innerText = "";
};