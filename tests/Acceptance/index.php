<?php

declare(strict_types=1);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yii Error Handler Bridge Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        h1, h2 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .renderer-section {
            margin-bottom: 30px;
        }
        .verbosity-buttons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            color: #fff;
            background-color: #337ab7;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-basic {
            background-color: #5cb85c;
        }
        .btn-verbose {
            background-color: #f0ad4e;
        }
        .btn-debug {
            background-color: #d9534f;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .description {
            color: #666;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Yii Error Handler Bridge Demo</h1>
    <p>This sandbox demonstrates exception rendering using different renderers and verbosity levels.</p>

    <div class="renderer-section">
        <h2>HTML Renderer</h2>
        <div class="description">Renders an exception in HTML format</div>
        <div class="verbosity-buttons">
            <a href="/html-exception?verbosity=basic" class="btn btn-basic">Basic</a>
            <a href="/html-exception?verbosity=verbose" class="btn btn-verbose">Verbose</a>
            <a href="/html-exception?verbosity=debug" class="btn btn-debug">Debug</a>
        </div>
    </div>

    <div class="renderer-section">
        <h2>JSON Renderer</h2>
        <div class="description">Renders an exception in JSON format</div>
        <div class="verbosity-buttons">
            <a href="/json-exception?verbosity=basic" class="btn btn-basic">Basic</a>
            <a href="/json-exception?verbosity=verbose" class="btn btn-verbose">Verbose</a>
            <a href="/json-exception?verbosity=debug" class="btn btn-debug">Debug</a>
        </div>
    </div>

    <div class="renderer-section">
        <h2>Plain Text Renderer</h2>
        <div class="description">Renders an exception in plain text format</div>
        <div class="verbosity-buttons">
            <a href="/plain-exception?verbosity=basic" class="btn btn-basic">Basic</a>
            <a href="/plain-exception?verbosity=verbose" class="btn btn-verbose">Verbose</a>
            <a href="/plain-exception?verbosity=debug" class="btn btn-debug">Debug</a>
        </div>
    </div>

    <div class="renderer-section">
        <h2>XML Renderer</h2>
        <div class="description">Renders an exception in XML format</div>
        <div class="verbosity-buttons">
            <a href="/xml-exception?verbosity=basic" class="btn btn-basic">Basic</a>
            <a href="/xml-exception?verbosity=verbose" class="btn btn-verbose">Verbose</a>
            <a href="/xml-exception?verbosity=debug" class="btn btn-debug">Debug</a>
        </div>
    </div>

    <p>To run this demo, use the PHP built-in web server:</p>
    <pre>php -S localhost:8000 server.php</pre>
</body>
</html>
