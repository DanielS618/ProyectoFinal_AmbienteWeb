document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("modal-platillo");
    const modalImg = document.getElementById("modal-img");
    const modalTitle = document.getElementById("modal-title");
    const modalDesc = document.getElementById("modal-desc");
    const closeModal = document.getElementById("close-modal");

    // Nombres + ingredientes por platillo
    const platillos = {
        "1.jpeg": {
            nombre: "Arroz Cantonés",
            desc: "Arroz salteado con huevo, cebollín, salsa de soya y camarones."
        },
        "2.png": {
            nombre: "Chop Suey Frito",
            desc: "Fideos chinos salteados con pollo, cerdo, vegetales y salsa oriental."
        },
        "3.png": {
            nombre: "Chop Suey en Salsa",
            desc: "Vegetales mixtos con carne de res en salsa especial."
        },
        "4.png": {
            nombre: "Vegetales con Carne de Res",
            desc: "Brócoli, zanahoria, cebolla y carne de res salteados."
        },
        "5.png": {
            nombre: "Camarones Empanizados",
            desc: "Camarones empanizados con papas fritas y salsa tártara."
        },
        "6.png": {
            nombre: "Tacos Chinos",
            desc: "Rollitos rellenos con vegetales, pollo y acompañados de salsa agridulce."
        },
        "7.png": {
            nombre: "Espagueti en Salsa Blanca",
            desc: "Pasta en salsa cremosa con camarones, especias y tostadas."
        },
        "8.png": {
            nombre: "Casado Chino",
            desc: "Arroz frito, chow mein y chop suey con carnes mixtas."
        },
        "9.png": {
            nombre: "Arroz Cantones",
            desc: "Arroz frito con huevo, vegetales y mezcla de carnes."
        },
        "10.png": {
            nombre: "Dedos de Pollo",
            desc: "Pechuga de pollo empanizada, papas fritas y aderezo."
        },
        "11.png": {
            nombre: "Pollo Frito",
            desc: "Piezas de pollo empanizadas con acompañamiento."
        },
        "12.png": {
            nombre: "Hamburguesa Especial",
            desc: "Carne, queso, jamón, vegetales frescos y papas fritas."
        }
    };

    // Evento para abrir el modal con nombre + ingredientes
    document.querySelectorAll(".gallary-item").forEach(item => {
        item.addEventListener("click", () => {
            const img = item.querySelector("img").getAttribute("src");
            const fileName = img.split("/").pop();

            const data = platillos[fileName];

            if (data) {
                modalImg.src = img;
                modalTitle.textContent = data.nombre;
                modalDesc.textContent = data.desc;
            } else {
                modalTitle.textContent = "Platillo";
                modalDesc.textContent = "Descripción no disponible.";
            }

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