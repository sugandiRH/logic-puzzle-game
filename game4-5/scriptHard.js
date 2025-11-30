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

function updateDisplay(){
    let display = Number(selected.join(''));
    document.getElementById('selectNum').value = display;

    // alert(display)
    // const display = document.getElementById('selectedNumbers');
    // display.textContent = selected.length 
    //     ? "Selected: " + selected.join("")
    //     : "Selected: None";
}

function checkNum(){
    let checkNum = document.getElementById('selectNum').value;
    alert(checkNum);
    window.location.reload();
}

function clearNum(){
    document.getElementById('selectNum').value = "";
    selected = [];
    alert(selected);
    window.location.reload();

}
// document.getElementById('checkBtn').addEventListener('click', () => {
//     const display = document.getElementById('selectedNumbers');
//     alert(display);
    
// });

// document.getElementById('clearBtn').addEventListener('click', () => {
//     // document.getElementById('selectNum') = "None";
//     alert("hi");
// });