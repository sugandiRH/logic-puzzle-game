let selected = [];

document.querySelectorAll('.number').forEach(num => {
    num.addEventListener('click', () => {
        const value = num.innerText.trim();

        if (selected.includes(value)) {
            // unselect if clicked again
            selected = selected.filter(n => n !== value);
            num.classList.remove('selected');
        } else {
            if (selected.length < 2) {
                selected.push(value);
                num.classList.add('selected');
            }
        }

        updateDisplay();
    });
});

function updateDisplay(){
    const display = document.getElementById('selectedNumbers');
    display.textContent = selected.length 
        ? "Selected: " + selected.join("")
        : "Selected: None";
}

document.getElementById('checkBtn').addEventListener('click', () => {
    const display = document.getElementById('selectedNumbers');
    alert(display);
    
});

document.getElementById('clearBtn').addEventListener('click', () => {
    // document.getElementById('selectNum') = "None";
    alert("hi");
});