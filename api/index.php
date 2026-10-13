<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

// Force proper headers for Laravel on Vercel
header_remove('Content-Type');
header('Content-Type: text/html; charset=UTF-8');

// Arahkan request dari Vercel Serverless Function ke public/index.php Laravel
require __DIR__ . '/../public/index.php';
