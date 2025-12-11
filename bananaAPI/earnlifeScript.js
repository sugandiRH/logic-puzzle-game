let selected = [];

document.querySelectorAll('.number').forEach(num => {
    num.addEventListener('click', () => {
        const value = num.innerText.trim();

        if (selected.includes(value)) {
            if (selected.length < 2) {
                selected.push(value);
                // alert(selected);
            } else{
                if (selected[0]==selected[1]){
                    selected.pop();
                }else{
                    selected = selected.filter(n => n !== value);
                    num.classList.remove('selected');
                }
                // alert(selected);
            }
            
        } else {
            if (selected.length < 2) {
                selected.push(value);
                num.classList.add('selected');
            }
        }

        updateDisplay();
    });
});


function clearNum(){
    document.getElementById('selectNum').value = "";
    selected = [];
    document.querySelectorAll('.number').forEach(el => {
        el.classList.remove('selected');
    });
}

function updateDisplay(){
    let display = Number(selected.join(''));
    document.getElementById('selectNum').value = display;
}

let lost = 0;
function checkBanana() {
    const selected = Number(document.getElementById('selectNum').value);
    // if(isNaN(selected)){
    //     alert("Please select a number first!");
    //     return;
    // }
    // alert("Selected: " + selected + ", Correct: " + window.correctAnswer);

    if (selected === window.correctAnswer) {
        setTimeout(() => {
                document.getElementById('popup').classList.add('active');
        }, 1000);
        // alert("Correct!");
        // reload new puzzle
        // loadBananaPuzzle();
    } else {
        lost = lost + 1;
        if (lost <= 1) {
            // alert("Wrong! Try again.");
            setTimeout(() => {
                document.getElementById('msg').innerText = "Selected: " + selected + ", Correct: " + window.correctAnswer;
                    document.getElementById('popupUnsuccess').classList.add('active');
            }, 1000);
            clearNum();
        }
        else{
            setTimeout(() => {
                document.getElementById('playAgainBtn').style.display = "none";
                document.getElementById('msg').innerText = "Game Over! No more lives. Correct answer was: " + window.correctAnswer;
                    document.getElementById('popupUnsuccess').classList.add('active');
            }, 1000);
            clearNum();        
        }  
    }
}

document.getElementById('playAgainBtn').addEventListener('click', () => {
    document.getElementById('popupUnsuccess').classList.remove('active');
    loadBananaPuzzle();
});

document.getElementById('backBtn1').addEventListener('click', () => {
    // Go back to game selection
    window.location.href = '../gamechoosePG/game(4-5).php';
});
document.getElementById('backBtn').addEventListener('click', () => {
    // Go back to game selection
    window.location.href = '../gamechoosePG/game(4-5).php';
});

// Close popup when overlay is clicked
document.querySelector('.popup .overlay').addEventListener('click', () => {
    document.getElementById('popup').classList.remove('active');
});

document.querySelector('.popupUnsuccess .overlay1').addEventListener('click', () => {
    document.getElementById('popup').classList.remove('active');
});