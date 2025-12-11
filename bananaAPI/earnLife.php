<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://www.marcconrad.com/uob/banana/banana.js"></script>
    <link rel="stylesheet" href="earnLife.css">
</head>
<body>
    <div class="wrapper">
        <div class="wrap">
            <div class="image-box">
                <img id="bananaPuzzle" src="" alt="Banana Puzzle">
                <div id="bananaError" style="color:darkred; margin-top:8px; display:none;"></div>
            </div>
            <div class="board">
                <div class="number-board">
                    <?php 
                        for ($i = 0; $i < 10; $i++) {
                            echo "<div class='number'> <h1> $i </h1> </div>";
                        }
                    ?>    
                </div>

                <div class="selection-area">
                    <div class="selectedNumbers" id="selectedNumbers">Selected: <input type ="text" class="selectNum" id="selectNum" placeholder="None"></input></div>
                    <button class="checkBtn" id="checkBtn" onclick="checkBanana()">CHECK</button>
                    <button class="clearBtn" id="clearBtn" onclick="clearNum()">CLEAR</button>
                    <button class="nextBtn" id="nextBtn" onclick="nextQ()">Next</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        async function loadBananaPuzzle() {
            const errNode = document.getElementById('bananaError');
            errNode.style.display = 'none';
            errNode.textContent = '';
            try {
                const res = await fetch('banana_proxy.php');
                // try to parse JSON body even on non-ok to get server error details
                const text = await res.text();
                let data = null;
                try { data = JSON.parse(text); } catch(e){ /* ignore */ }

                if (!res.ok) {
                    const msg = (data && data.error) ? (data.error + (data.details ? ': ' + data.details : '')) : ('Proxy error: ' + res.status);
                    throw new Error(msg);
                }

                if (!data || !data.question || typeof data.solution === 'undefined') {
                    throw new Error('Invalid data from proxy');
                }

                document.getElementById('bananaPuzzle').src = data.question;
                window.correctAnswer = Number(data.solution);
            } catch (e) {
                console.error(e);
                // show inline error message and a fallback alt text
                const errNode = document.getElementById('bananaError');
                errNode.textContent = 'Puzzle not available — ' + e.message;
                errNode.style.display = 'block';
                document.getElementById('bananaPuzzle').alt = 'Puzzle not available';
            }
        }
        loadBananaPuzzle();
    </script>
   <script src="earnlifeScript.js"></script>


</body>
</html>