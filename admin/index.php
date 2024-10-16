<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        /* Reset browser default styles */ 
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; /* Background warna biru cerah */
            color: #333;
            text-align: center;
            padding: 20px;
        }

        h1 {
            color: #00796b; /* Hijau gelap */
            margin-bottom: 20px;
            font-size: 2.5rem;
        }

        a {
            display: inline-block;
            margin: 10px 0;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #0288d1; /* Biru cerah */
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0277bd; /* Biru lebih gelap */
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 2rem;
            }

            a {
                font-size: 1rem;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <h1>DASHBOARD ADMIN</h1>
    <a href="./event">Event</a><br>
    <a href="./game">Game</a><br>
    <a href="./team">Team</a><br>
    <a href="./achievement/">Achievement</a>
</body>
</html>
