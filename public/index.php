<?php
if (isset($_SERVER['HTTP_ALI_SWIFT_STAT_HOST'])) { $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_ALI_SWIFT_STAT_HOST']; $_SERVER['HTTP_HOST'] = $_SERVER['HTTP_ALI_SWIFT_STAT_HOST']; } define('LARAVEL_START', microtime(true)); require __DIR__ . '/../vendor/autoload.php'; $speff3ac = (require_once __DIR__ . '/../bootstrap/app.php'); $sp063b26 = $speff3ac->make(Illuminate\Contracts\Http\Kernel::class); $sp81fa79 = $sp063b26->handle($sp0aae4c = Illuminate\Http\Request::capture()); $sp81fa79->send(); $sp063b26->terminate($sp0aae4c, $sp81fa79);