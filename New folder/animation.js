document.addEventListener('DOMContentLoaded', () => {
    const playButton = document.getElementById('play');
    
    playButton.style.transition = 'transform 0.3s ease';

    playButton.addEventListener('mouseenter', () => {
        playButton.style.transform = 'scale(1.2)';
    });

    playButton.addEventListener('mouseleave', () => {
        playButton.style.transform = 'scale(1)';
    });
});

