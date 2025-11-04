<?php
$images = [
    "pics/brain.png",
    "pics/dolphin.png",
    "pics/elephant.png",
    "pics/monkey.png",
    "pics/octo.png",
    "pics/raven.png",
];

$randomImage = $images[array_rand($images)];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
</head>

<style>
    * {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
}

body {
    margin: 0;
    background-image: url(pics/bg.png);
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    font-family: Arial, sans-serif;

}

.section1 {
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex;
    justify-content: center;
    align-items: center;
}

.logo {
    width: 400px;
    height: 400px;
    border-radius: 50%;
    object-fit: cover;
}

.game-table {
    position: fixed;
    top: 45%;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    border-radius: 12px;
    padding: 25px;
}

.game-table th {
    color: white;
    padding: 10px;
    text-align: center;
}

.game-table input {
    width: 100px;
    padding: 10px;
    margin: 5px;
    border-radius: 6px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    background-color: rgba(0, 0, 0, 0.4);
    color: #f1f1f1;
    font-size: 0.9rem;
}

button {
    padding: 8px;
    background-color: #0c7230ff;
    color: white;
    font-size: 1rem;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0c723080;
}
</style>

<body>
    <section class="section1">
        <img src="<?php echo $randomImage; ?>" alt="Random Image" class="logo">
    </section>
    
    <section class="section2">
        <form id="gameForm">
            <table class="game-table" id="gameTable">
                <tr>
                    <th>Emer</th>
                    <th>Mbiemer</th>
                    <th>Shtet</th>
                    <th>Qytet</th>
                    <th>Kafsh</th>
                    <th>Send</th>
                </tr>
                <tr>
                    <td><input type="text" name="emer[]"></td>
                    <td><input type="text" name="mbiemer[]"></td>
                    <td><input type="text" name="shtet[]"></td>
                    <td><input type="text" name="qytet[]"></td>
                    <td><input type="text" name="kafsh[]"></td>
                    <td><button type="button" onclick="addNewRow()">Send</button></td>
                </tr>
            </table>
        </form>
    </section>

    <script>
    function addNewRow() {
        // Get the table
        const table = document.getElementById('gameTable');
        
        // Create new row
        const newRow = table.insertRow(-1);
        
        // Add cells
        for(let i = 0; i < 5; i++) {
            const cell = newRow.insertCell(i);
            const input = document.createElement('input');
            input.type = 'text';
            input.name = ['emer', 'mbiemer', 'shtet', 'qytet', 'kafsh'][i] + '[]';
            cell.appendChild(input);
        }
        
        // Add send button
        const sendCell = newRow.insertCell(5);
        sendCell.innerHTML = '<button type="button" onclick="addNewRow()">Send</button>';
    }
    </script>

</body>
</html>
