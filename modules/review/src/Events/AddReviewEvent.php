<?php

namespace Modules\Review\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Review\Http\Resources\ReviewResource;
use Modules\Review\Models\Review;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

class AddReviewEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param Review $review
     */
    public function __construct(
        public Review $review,
    )
    {
    }

    /**
     * @return Channel[]
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('public'),
        ];
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'new.review';
    }

    /**
     * @return ReviewResource
     * @throws JsonException
     */
    public function broadcastWith()
    {
        return Json::decode(ReviewResource::make($this->review)->toJson(), true);
    }
}
