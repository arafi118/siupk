<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <meta charset="UTF-8">
    <title>Form Generate</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
        }
        input[type="submit"] {
            padding: 10px 16px;
            font-size: 14px;
            cursor: pointer;
        }
        .result-text3 {
            font-size: 12px;
            color: #777;
            margin-top: -10px;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Proses Generate</h2>
        <form action="{{ url('/generate-bunga') }}" method="get">
            <div class="form-group">
                <label for="id">CIF</label>
                <input type="text" id="id" name="id" placeholder="semua CIF">
            </div>
            <div class="result-text3">
                jika hanya sebagian, ketiklah: <strong>CIF, CIF</strong> dst
            </div>
            <input type="submit" value="Kirim">
        </form>
    </div>
</body>
</html>
