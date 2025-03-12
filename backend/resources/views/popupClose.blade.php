<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechar Popup</title>
</head>
<body>
    <script>
        window.opener.postMessage({ 
            name: "{{ $name }}", 
            email: "{{ $email }}", 
            google_token: "{{ $google_token }}" 
        }, 'http://localhost:5173');
        window.close();
    </script>
</body>
</html>
