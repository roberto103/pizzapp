<?php

require_once 'Sessao.php';
Sessao::logout();
header('Location: ../login.php');