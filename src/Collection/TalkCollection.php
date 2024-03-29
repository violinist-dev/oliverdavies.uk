<?php

declare(strict_types=1);

namespace App\Collection;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * @template TKey of array-key
 * @template TValue
 */
final class TalkCollection extends Collection
{
    private const DATE_FORMAT = 'Y-m-d';
    private const KEY_EVENTS = 'events';
    private const KEY_EVENT_DATE = 'date';

    /**
     * @return self<TKey, TValue>
     */
    public function getEvents(): self
    {
        return $this->flatMap(fn($talk): array => (array) $talk[self::KEY_EVENTS]);
    }

    /**
     * @return self<TKey, TValue>
     */
    public function onlyPastTalks(): self
    {
        $today = Carbon::today()->format(self::DATE_FORMAT);

        return $this->filter(fn(array $event): bool => $event[self::KEY_EVENT_DATE] < $today);
    }
}
