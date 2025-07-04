@extends('adminlte::auth.login')

@push('css')
    <style>
        /* Define a imagem de fundo para o body da página de login */
        .login-page {
            background-image: url('{{ asset('img/bg.jpg') }}'); /* AJUSTE AQUI O CAMINHO PARA SUA IMAGEM */
            background-size: cover;          /* Garante que a imagem cubra toda a área */
            background-repeat: no-repeat;    /* Evita que a imagem se repita */
            background-position: center center; /* Centraliza a imagem */
            position: relative;              /* Necessário para o overlay */
            overflow: hidden;                /* Garante que o pseudo-elemento não vaze */
        }

        /* Adiciona um overlay escuro (opcional, mas recomendado para legibilidade) */
        .login-page::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Overlay preto com 50% de opacidade */
            z-index: -1; /* Coloca o overlay atrás do conteúdo do formulário */
        }

        body, #main-topnav, .content-wrapper, .main-content {
            transition: background-color 0.4s, color 0.4s;
        }
    </style>
@endpush

{{-- Você pode ter outras seções @section('title') ou @section('body_class') aqui --}}

<script>
    function setTheme(theme) {
        if (theme === 'dark') {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
        localStorage.setItem('theme', theme);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);
    });
</script>