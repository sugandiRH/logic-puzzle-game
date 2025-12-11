var btn = document.getElementById("btn");
function leftClick(){
    btn.style.left = "0";
    window.location.href = "countingGame_Easy.php";
}
function rightClick(){
    btn.style.left = "110px";
    window.location.href = "countingGame_Hard.php";
} 