<?php

namespace Modules\Review\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Review\Http\Resources\ReplyResource;
use Modules\Review\Http\Resources\ReviewResource;
use Modules\Review\Models\Reply;
use Modules\Review\Models\Review;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

class AddReplyEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @param Reply $reply
     * @param Review $review
     */
    public function __construct(
        public Reply $reply,
        public Review $review,
    )
    {
    }

    /**
     * @return PrivateChannel[]
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('private.'.$this->review->user_id),
        ];
    }

    /**
     * @return string
     */
    public function broadcastAs()
    {
        return 'new.reply';
    }

    /**
     * @return array
     * @throws JsonException
     */
    public function broadcastWith()
    {
        return [
            'review' => Json::decode(ReviewResource::make($this->review)->toJson(), true),
            'reply' => Json::decode(ReplyResource::make($this->reply)->toJson(), true),
        ];
    }
}
