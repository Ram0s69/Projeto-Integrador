const alertas = document.querySelectorAll(".alerta");

if (alertas) {
    alertas.forEach(alerta => {
        alerta.querySelector("button").addEventListener("click", () => {
            alerta.remove();
        });
    });
}