<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        overflow: hidden;
    }

    li {
        list-style: none;
    }
    a {
        text-decoration: none;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 50px 20px 50px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        color: black;
    }

    .btn {
        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 14px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    .footer {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 0;
        position: absolute;
        width: 100%;
        bottom: 0;
        background-color: #000000;
        color: rgb(255, 255, 255);
    }

    .section {
        display: flex;
        padding: 20px 50px 20px 50px;
        gap: 20px;
    }

    .left {
        width: 60%;
        height: 300px;
    }

    .left img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .misi {
        margin-top: 20px;
    }

    .visi {
        margin-top: 20px;
    }
</style>
<body>
    <header class="header">
        <h1>Website PPDB 2025</h1>
        <div>
            <a href="formoperator.html" class="btn">Login</a>
        </div>
    </header>

    <section class="section">
        <div class="left">
            <img src="baner.jpg" alt="">
        </div>
        <div class="right">
            <h1>REKAYASA PERANGKAT LUNAK</h1>
            <div>
                <h3>VISI</h3>
                <p>"menjadikan lulusan yabg tangguh dalam teknologu informasi berkarakter dan siap menghadapi Globalisasi"</p>
            </div>
            <div class="misi">
                <h3>MISI</h3>
               <ol type="1">
                <li>1.Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, aliquid eius voluptatibus suscipit dignissimos unde nesciunt quaerat officia dolorem odit?</li>
                <li>2.Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, aliquid eius voluptatibus suscipit dignissimos unde nesciunt quaerat officia dolorem odit?</li>
                <li>3.Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, aliquid eius voluptatibus suscipit dignissimos unde nesciunt quaerat officia dolorem odit?</li>
            </ol>
            </div>
            <div class="visi">
                <h3>KOMPETENSI KEAHLIAN XI KOMPUTER & INFORMATIKA</h3>
                <ol type="1">
                    <li>1.Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, aliquid eius voluptatibus suscipit dignissimos unde nesciunt quaerat officia dolorem odit?</li>
                    <li>2.Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, aliquid eius voluptatibus suscipit dignissimos unde nesciunt quaerat officia dolorem odit?</li>
                    <li>3.Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, aliquid eius voluptatibus suscipit dignissimos unde nesciunt quaerat officia dolorem odit?</li>
                    <li>4.Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam, aliquid eius voluptatibus suscipit dignissimos unde nesciunt quaerat officia dolorem odit?</li>
                </ol>
            </div>
        </div>
    </section>

    <footer class="footer">
        <span> &copy; 2024-2025 UKK Jurusan Rekayasa Perangkat Lunak</span>
    </footer>

</body>
</html>