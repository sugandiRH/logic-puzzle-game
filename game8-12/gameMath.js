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

}

function clearNum(){
    document.getElementById('selectNum').value = "";
    selected = [];
    document.querySelectorAll('.number').forEach(el => {
        el.classList.remove('selected');
    });

}

let lost = 0;
function checkNum(num){
    // alert("Checking number...");
    let checkNum = document.getElementById('selectNum').value;

    if (checkNum == num & lost < 3){
        document.getElementById('message1').innerText = "Congratulations! <br> Keep Going!";
        document.getElementById('message2').innerText = " Let's go to the next level ";
        document.getElementById('nextBtn').style.display='block';
    } else {
        if (lost <= 2) {
            lost = lost + 1;
            heart = "heart" + lost;
            document.getElementById(heart).style.display = "none";

            if (lost <= 2){
                document.getElementById('message1').innerText = "OOps!";
                document.getElementById('message2').innerText = " Don't worry, You Have one more life "

                document.getElementById('selectNum').value = "";
                selected = [];
                document.querySelectorAll('.number').forEach(el => {
                    el.classList.remove('selected');
                });
                
            } else if (lost==3){
                // update table to wait 15 minites
                updateTimer(); 
                document.getElementById('message1').innerText = "OOps!";
                document.getElementById('message2').innerText = " Game Over! No more lives ";

                setTimeout(() => {
                    document.getElementById('popup').classList.add('active');
                }, 1000);
            }
        }else {
            setTimeout(() => {
                document.getElementById('popup').classList.add('active');
            }, 1000);
        }
        
    }
    
}

// Close popup when overlay is clicked
document.querySelector('.popup .overlay').addEventListener('click', () => {
    document.getElementById('popup').classList.remove('active');
});

document.getElementById('bananaGameBtn').addEventListener('click', () => {
    window.location.href = '../bananaAPI/earnLife.php';
});

function goNextLevel() {
    fetch("../updatePlayerLevel.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body:"game=math"
    })
    .then(response => response.text())
    .then(data => {
        console.log("PHP says:", data);

        // After updating, reload next level UI
       window.location.href = '../game8-12/gamePage.php';
    })
    .catch(error => console.error("Error:", error));
}

function updateTimer() {
    // alert("called");
    fetch("../updateTimer.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body:"game=math"
    })
    .then(response => response.text())
    .then(data => {
        console.log("PHP says:", data);


    //    window.location.href = '../game4-5/countingGame_Hard.php';
    // location.reload();
    })
    .catch(error => console.error("Error:", error));
}