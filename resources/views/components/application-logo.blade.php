Set-Content -Path "resources\views\components\application-logo.blade.php" -Value @"
<svg viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg" {{ `$attributes` }}>
    <path d="M25 0C11.2 0 0 11.2 0 25s11.2 25 25 25 25-11.2 25-25S38.8 0 25 0zm0 45c-11 0-20-9-20-20s9-20 20-20 20 9 20 20-9 20-20 20z" fill="currentColor"/>
</svg>
"@