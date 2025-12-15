<?php

use App\Http\Controllers\Api\WebhookController;

Route::post('/webhook/surat-sakit', [WebhookController::class, 'storeSuratSakit']);
