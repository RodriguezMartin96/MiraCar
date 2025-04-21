/**
 * Script para manejar la reproducción de videos en el dashboard
 */
document.addEventListener('DOMContentLoaded', function() {
    // Referencias a elementos del DOM
    const videoModal = document.getElementById('videoModal');
    const modalTitle = document.getElementById('videoModalLabel');
    const videoFrame = document.getElementById('videoFrame');
    
    // Verificar que los elementos existan
    if (!videoModal || !modalTitle || !videoFrame) {
        console.error('No se encontraron los elementos necesarios para el modal de video');
        return;
    }
    
    // Evento para cuando se muestra el modal
    videoModal.addEventListener('show.bs.modal', function(event) {
        // Obtener el botón que activó el modal
        const button = event.relatedTarget;
        
        if (!button) {
            console.error('No se pudo determinar qué elemento activó el modal');
            return;
        }
        
        // Obtener datos del botón
        const videoTitle = button.getAttribute('data-video-title');
        const videoSrc = button.getAttribute('data-video-src');
        
        console.log(`Cargando video: ${videoTitle} - ${videoSrc}`);
        
        // Actualizar el título del modal
        modalTitle.textContent = `Tutorial: ${videoTitle}`;
        
        // Cargar el video en el iframe
        videoFrame.src = videoSrc;
    });
    
    // Evento para cuando se oculta el modal
    videoModal.addEventListener('hidden.bs.modal', function() {
        // Detener la reproducción del video al cerrar el modal
        videoFrame.src = '';
    });
    
    // Efecto de hover para las tarjetas de video
    const videoCards = document.querySelectorAll('.video-card');
    videoCards.forEach(card => {
        // Añadir efecto de elevación al pasar el mouse
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
        
        // Añadir efecto al hacer clic
        card.addEventListener('click', function() {
            this.classList.add('clicked');
            
            setTimeout(() => {
                this.classList.remove('clicked');
            }, 300);
        });
    });
    
    // Animación de entrada para los elementos
    const animateElements = () => {
        const elements = document.querySelectorAll('.video-card');
        elements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    };
    
    // Ejecutar animación después de un breve retraso
    setTimeout(animateElements, 300);
});