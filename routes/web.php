<?php

use App\Livewire\CareerAI\AiQuestions;
use App\Livewire\Counter;
use App\Livewire\GenerateQuestines;
use App\Livewire\Profile;
use App\Livewire\Questionnaire;
use Illuminate\Support\Facades\Route;

Route::get('/', Profile::class);


Route::get('/generateQuestines', GenerateQuestines::class)->name('generateQuestines');
Route::get('/questionnaire', Questionnaire::class)->name('questionnaire');
Route::get('/AI-questions', AiQuestions::class)->name('AiQuestions');
