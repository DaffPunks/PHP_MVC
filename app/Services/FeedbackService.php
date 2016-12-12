<?php

class FeedbackService
{

    static function feedbackIsVisible($status)
    {
        return Auth::isAdmin() || $status == 1;
    }
}