function toggleFullScreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen()
            .then(() => localStorage.setItem('pantallaCompleta', 'true'))
            .catch((err) => console.error(`Error al activar pantalla completa: ${err}`));
    } else {
        document.exitFullscreen()
            .then(() => localStorage.setItem('pantallaCompleta', 'false'))
            .catch((err) => console.error(`Error al salir de pantalla completa: ${err}`));
    }
}



document.addEventListener('DOMContentLoaded', () => {
    setDarkClassFromStorage();

    if (localStorage.getItem('pantallaCompleta') === 'true' && !document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch((err) => {
            console.warn("No se pudo restaurar pantalla completa:", err);
        });
    }
});
