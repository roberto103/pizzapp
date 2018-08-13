<?php

require_once 'Sessao.php';
Sessao::logout();
header('Location: ../index.php');