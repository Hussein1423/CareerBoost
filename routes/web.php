<?php

use App\Livewire\CareerAI\AiQuestions;
use App\Livewire\CareerAI\GenerateQuestines;
use App\Livewire\CareerAI\Questionnaire;
use App\Livewire\CareerAI\ReportsAnalysis;
use App\Livewire\CareerAI\UplaodJobProfile;

use App\Livewire\CareerAI\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);


Route::get('/interview_type', GenerateQuestines::class)->name('generateQuestines');
Route::get('/questionnaire', Questionnaire::class)->name('questionnaire');
Route::get('/AI_questions', AiQuestions::class)->name('AiQuestions');
Route::get('/Uplaod_Job_Profile', UplaodJobProfile::class)->name('Uplaod_Job_Profile');
Route::get('/ReportsAnalysis', ReportsAnalysis::class)->name('ReportsAnalysis');
