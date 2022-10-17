<?php

# Main
// Lugh::setUrl(array(
//     ""      => "public.MainController.Home",
// ));


Lugh::addGet("", "public.MainController.Home");
Lugh::addGet("analytics", "public.AnalyticsController.RegisterAccess");

Lugh::addGet("api/senha", "private.SenhasController.BuscarSenha");
Lugh::addPost("api/senha", "private.SenhasController.CriarSenha");
Lugh::addPut("api/senha", "private.SenhasController.AlterarSenha");

Lugh::addPost("api/encrypt", "private.CryptoController.Encrypt");
Lugh::addPost("api/decrypt", "private.CryptoController.Decrypt");

Lugh::addPost("api/auth/create", "private.AuthController.Criar");
Lugh::addPost("api/auth", "private.AuthController.Autenticar");
