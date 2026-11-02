<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('attorneys')
            ->whereNotNull('experience_points')
            ->where('experience_points', '!=', '')
            ->orderBy('id')
            ->each(function (object $attorney): void {
                $points = preg_split('/\r\n|\r|\n/', $attorney->experience_points) ?: [];
                $items = array_values(array_filter(array_map('trim', $points)));

                if (!$items) {
                    return;
                }

                $list = '<ul>' . implode('', array_map(
                    fn (string $point): string => '<li>' . htmlspecialchars($point, ENT_QUOTES, 'UTF-8') . '</li>',
                    $items
                )) . '</ul>';

                DB::table('attorneys')->where('id', $attorney->id)->update([
                    'experience' => trim((string) $attorney->experience) . $list,
                    'experience_points' => null,
                ]);
            });
    }

    public function down(): void
    {
        // The merged rich-text content intentionally remains in Experience.
    }
};
