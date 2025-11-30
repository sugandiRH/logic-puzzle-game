let selectedNum = null; // currently selected number

document.querySelectorAll('.number').forEach(num => {
    num.addEventListener('click', () => {
        const value = Number(num.innerText.trim());

        if (selectedNum === value) {
            // unselect if clicked again
            selectedNum = null;
            num.classList.remove('selected');
        } else {
            // remove highlight from previously selected number
            document.querySelectorAll('.number.selected').forEach(el => {
                el.classList.remove('selected');
            });

            // select new number
            selectedNum = value;
            num.classList.add('selected');
        }
        updateDisplay();
    });
});

function updateDisplay(){
    document.getElementById('selectNum').value = selectedNum;
}


function checkNum(){
    let checkNum = document.getElementById('selectNum').value;
    alert(checkNum);
    window.location.reload();
}