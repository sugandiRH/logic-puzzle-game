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

function checkBanana() {
    const selected = Number(document.getElementById('selectNum').value);
    // alert("Selected: " + selected + ", Correct: " + window.correctAnswer);

    if (selected === window.correctAnswer) {
        alert("Correct!");
        // reload new puzzle
        loadBananaPuzzle();
    } else {
        alert("Wrong! Try again.");
    }
}