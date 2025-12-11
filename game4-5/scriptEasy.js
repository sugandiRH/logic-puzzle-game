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

lost=0;
function checkNum(num){

    let checkNum = document.getElementById('selectNum').value;
    // alert("You selected " + checkNum);
    // alert("Correct number is " + num);
    if(checkNum == num & lost<2){
        // alert("Correct! You selected " + selectedNum);
        document.getElementById('message1').innerText = "";
        document.getElementById('message2').innerText = "";
        
        document.getElementById('message1').innerText = "Congratulations!";
        document.getElementById('message2').innerText = " Let's go to the next level ";
        document.getElementById('nextBtn').style.display='block';

    } else {
        if (lost <= 1) {
            lost=lost+1;
            heart = "heart" + lost;
            document.getElementById(heart).style.display = "none";

            // alert("Incorrect! You selected " + selectedNum + ", but the correct number is " + num);
            if (lost==1){
            document.getElementById('message1').innerText = "OOps!";
            document.getElementById('message2').innerText = " Don't worry, You Have one more life "
            } else if (lost==2){
                document.getElementById('message1').innerText = "OOps!";
                document.getElementById('message2').innerText = " Game Over! No more lives ";
            }
        } else {
            // Game Over - Show popup
            document.getElementById('message1').innerText = "OOps!";
            document.getElementById('message2').innerText = " Game Over! No more lives ";
            
            // Show popup after a short delay
            setTimeout(() => {
                document.getElementById('popup').classList.add('active');
            }, 1000);
        }   
    }
    // let checkNum = document.getElementById('selectNum').value;
    // alert(checkNum);
    // history.go();
}

// Popup button event listeners
document.getElementById('replayBtn').addEventListener('click', () => {
    // Reload the current page to replay
    location.reload();
});

document.getElementById('nextLevelBtn').addEventListener('click', () => {
    // Call PHP to update player level
    goNextLevel();
});

document.getElementById('backBtn').addEventListener('click', () => {
    // Go back to game selection
    window.location.href = '../gamechoosePG/game(4-5).php';
});

// Close popup when overlay is clicked
document.querySelector('.popup .overlay').addEventListener('click', () => {
    document.getElementById('popup').classList.remove('active');
});


function goNextLevel() {
    fetch("../updatePlayerLevel.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body:"game=counting"
    })
    .then(response => response.text())
    .then(data => {
        console.log("PHP says:", data);

        // After updating, reload next level UI
       window.location.href = '../game4-5/countingGame_Easy.php';
    })
    .catch(error => console.error("Error:", error));
}