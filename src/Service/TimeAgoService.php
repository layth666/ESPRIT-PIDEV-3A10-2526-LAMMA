<?php

namespace App\Service;

class TimeAgoService
{
    public function timeAgo(?\DateTimeInterface $dateTime): string
    {
        if (!$dateTime) return '';
        
        $now = new \DateTime();
        $diff = $now->diff($dateTime);
        
        if ($diff->i < 1) return "à l'instant";
        if ($diff->i < 60) return $diff->i . " min" . ($diff->i > 1 ? 's' : '') . " ago";
        if ($diff->h < 24) return $diff->h . " h" . ($diff->h > 1 ? 's' : '') . " ago";
        if ($diff->d < 7) return $diff->d . " j" . ($diff->d > 1 ? 's' : '') . " ago";
        if ($diff->d < 30) return floor($diff->d / 7) . " sem" . (floor($diff->d / 7) > 1 ? 's' : '') . " ago";
        if ($diff->d < 365) return floor($diff->d / 30) . " mois ago";
        
        return floor($diff->d / 365) . " an" . (floor($diff->d / 365) > 1 ? 's' : '') . " ago";
    }
}