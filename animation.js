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

document.addEventListener('DOMContentLoaded', () => {
    const nameList = document.getElementById('namesList');
    const countriesList = document.getElementById('countriesList');
    const ingredientsList = document.getElementById('ingredientsList');
    const nameInput = document.getElementById('nameInput');
    const countryInput = document.getElementById('countryInput');
    const ingredientInput = document.getElementById('ingredientInput');
    const nextButtons = document.querySelectorAll('#nameInput #next, #countryInput #next'); // Select "Next" buttons in the name and country forms

    let click = 0;
    countryInput.style.display = 'none';
    ingredientInput.style.display = 'none';
    countriesList.style.display = 'none';
    ingredientsList.style.display = 'none';


    nextButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent form submission

            if (click == 0) {
                nameInput.style.display = 'none';
                nameList.style.display = 'none';
                countryInput.style.display = 'block';
                countriesList.style.display = 'block';
                click = 1;
            } else if (click == 1) {
                countryInput.style.display = 'none';
                countriesList.style.display = 'none';
                ingredientInput.style.display = 'block';
                ingredientsList.style.display = 'block';
                click = 2;
            }
        });
    });
});

const audio = document.getElementById('backgroundAudio');
const playAudioButton = document.getElementById('playAudioButton');
const muteAudioButton = document.getElementById('muteAudioButton');

playAudioButton.addEventListener('click', function() {
    audio.play().then(() => {
        console.log('Audio started playing');
        muteAudioButton.disabled = false; // Enable mute/unmute button once audio starts
    }).catch(error => {
        console.error('Playback failed due to autoplay policy:', error);
    });
});

muteAudioButton.addEventListener('click', function() {
    if (audio.muted) {
        audio.muted = false;
        muteAudioButton.textContent = 'Mute Music'; // Change button text
    }
    else{
        audio.muted = true;
        muteAudioButton.textContent = 'Unmute Music'; // Change button text
    }
});

