document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modal-platillo");
    const modalImg = document.getElementById("modal-img");
    const modalTitle = document.getElementById("modal-title");
    const modalDesc = document.getElementById("modal-desc");
    const closeModal = document.getElementById("close-modal");

    // Descripciones de ejemplo para los platillos
    const descripciones = {
        "1.jpg": "Arroz Cantonés",
        "2.jpeg": "Chop Suey Frito",
        "3.jpeg": "Chop Suey en Salsa",
        "4.jpeg": "Vegetales con Carne de Res",
        "5.jpeg": "Camarones Empanizados en Salsa Tártara",
        "6.jpeg": "Tacos Chinos con Salsa Agridulce",
        "7.jpeg": "Espagueti en Salsa Blanca",
        "8.jpeg": "Casado Chino",
        "9.jpeg": "Cantones",
        "10.jpeg": "Dedos de Pollo",
        "11.jpeg": "Pollo Frito",
        "12.jpeg": "Hamburguesa Especial"
    };


    // Evento para abrir modal al hacer clic
    document.querySelectorAll(".gallary-item").forEach(item => {
        item.addEventListener("click", () => {
            const img = item.querySelector("img").getAttribute("src");
            const name = img.split("/").pop();

            modalImg.src = img;
            modalTitle.textContent = "Platillo #" + name.split(".")[0];
            modalDesc.textContent = descripciones[name] || "Descripción no disponible.";

            modal.style.display = "flex";
        });
    });

    // Cerrar modal con la X
    closeModal.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Cerrar modal haciendo clic fuera del contenido
    modal.addEventListener("click", (e) => {
        if (e.target === modal) modal.style.display = "none";
    });

});
