<?php

use App\Core\Entity\Finance;
use App\Infra\Database;
use App\Infra\Repository\FinanceRepository;

require_once __DIR__ . '/../autoload.php';

$finance = new Finance(null, $_POST['title'], $_POST['value'], $_POST['date']);
$database = new Database();
$financeRepository = new FinanceRepository($database);

$financeRepository->create($finance);
header('Location: index.php', true, 303);
