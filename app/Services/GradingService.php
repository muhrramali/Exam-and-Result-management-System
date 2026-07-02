<?php

namespace App\Services;

use App\Models\GradingScale;

class GradingService
{
    public function gradeForPercentage(float $percentage): ?GradingScale
    {
        return GradingScale::query()
            ->where('Min_Percent', '<=', $percentage)
            ->where('Max_Percent', '>=', $percentage)
            ->orderByDesc('Min_Percent')
            ->first();
    }

    public function letterGrade(float $percentage): string
    {
        return $this->gradeForPercentage($percentage)?->Grade_Letter ?? 'F';
    }

    public function isPassing(float $percentage): bool
    {
        $grade = $this->gradeForPercentage($percentage);

        if (! $grade) {
            return false;
        }

        return $grade->Grade_Letter !== 'F' && $grade->Grade_Point > 0;
    }

    public function markPercentage(float $obtained, float $max): float
    {
        if ($max <= 0) {
            return 0;
        }

        return round(($obtained / $max) * 100, 2);
    }
}
