<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <meta charset="UTF-8">
    <title>Hasil Generate</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 40px;
        }
        .step-container {
            display: flex;
            gap: 8px;
            margin-bottom: 20px;
        }
        .step {
            padding: 8px 12px;
            background-color: #ccc;
            border-radius: 4px;
        }
        .step.active {
            background-color: #4CAF50;
            color: white;
        }
        .result-container {
            max-width: 600px;
            margin: auto;
        }
        .result-text, .result-text2 {
            font-size: 16px;
            margin-bottom: 12px;
        }
        .back-button {
            padding: 8px 12px;
            background-color: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .process-form input,
        .process-form button {
            display: block;
            margin-top: 10px;
        }
        .process-form button {
            padding: 8px 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="step-container">
        <div class="step active">STEP 1</div>
        <div class="step active">STEP 2</div>
        <div class="step {{ $isDone ? 'active' : '' }}">STEP 3</div>
    </div>

    <div class="result-container">
        <div class="result-text2">
            Total Simpanan yang akan di proses adalah <strong>{{ $total }}</strong> data.
        </div>

        @if ($isDone)
            <div class="result-text">Proses generate bunga telah selesai.</div>
            <a href="{{ url('/generate-bunga') }}" class="back-button">Ulangi</a>
        @else
            <form action="{{ url('/generate-bunga') }}" method="get" class="process-form" id="runForm">
                <input type="hidden" name="id" value="{{ $id }}">
                <input type="text" name="start" id="start" value="{{ $start }}" readonly>
                <input type="hidden" name="limit" id="limit" value="{{ $limit }}" readonly>
                <button type="submit" name="migrate" id="runButton">
                    Loading<span id="loadingDots">.</span>
                </button>
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var button = document.getElementById('runButton');
                    var loadingDots = document.getElementById('loadingDots');
                    var dotCount = 0;

                    function animateDots() {
                        dotCount = (dotCount % 4) + 1;
                        loadingDots.textContent = '.'.repeat(dotCount);
                    }

                    var interval = setInterval(animateDots, 500);
                    button.addEventListener('click', f
