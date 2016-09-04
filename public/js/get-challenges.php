<?php
use App\Http\Controllers\ChallengesController;

echo json_encode(ChallengesController::getChallenges());