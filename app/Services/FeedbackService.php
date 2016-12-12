<?php

class FeedbackService
{

    /** Feedback is visible if its considered or you are Admin */
    public static function feedbackIsVisible($status)
    {
        return Auth::isAdmin() || $status == 1;
    }
}