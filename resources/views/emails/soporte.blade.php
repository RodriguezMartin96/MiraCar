<!DOCTYPE html>
<html>
<head>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('galeria/logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('galeria/logo.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('galeria/logo.png') }}">

    <meta charset="utf-8">
    <title>Solicitud de Soporte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
        }
        .header {
            background-color: #235390;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        .label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .value {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #f9f9f9;
            border-radius: 3px;
        }
        .email-info {
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Solicitud de Soporte - MiraCar</h2>
    </div>
    
    <div class="email-info">
        <strong>De:</strong> {{ $fromEmail }} {{ $tallerName ? '(' . $tallerName . ')' : '' }}<br>
        <strong>Para:</strong> soporte@miracar.com<br>
        <strong>Asunto:</strong> Soporte MiraCar: {{ $asunto }}
    </div>
    
    <div class="content">
        <p>Se ha recibido una nueva solicitud de soporte:</p>
        
        <div class="label">De:</div>
        <div class="value">{{ $fromEmail }} {{ $tallerName ? '(' . $tallerName . ')' : '' }}</div>
        
        <div class="label">Asunto:</div>
        <div class="value">{{ $asunto }}</div>
        
        <div class="label">Descripción:</div>
        <div class="value">{{ $descripcion }}</div>
    </div>
    
    <div class="footer">
        <p>Este correo fue enviado automáticamente desde la plataforma MiraCar.</p>
        <p>Por favor no responda directamente a este correo. Para responder, inicie sesión en el sistema.</p>
    </div>
</body>
</html>