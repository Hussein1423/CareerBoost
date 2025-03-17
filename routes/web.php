<?php

use App\Livewire\CareerAI\AiQuestions;
use App\Livewire\CareerAI\GenerateQuestines;
use App\Livewire\CareerAI\Questionnaire;
use App\Livewire\CareerAI\UplaodJobProfile;

use Illuminate\Support\Facades\Route;

Route::get('/', UplaodJobProfile::class);


Route::get('/interview-type', GenerateQuestines::class)->name('generateQuestines');
Route::get('/questionnaire', Questionnaire::class)->name('questionnaire');
Route::get('/AI-questions', AiQuestions::class)->name('AiQuestions');
