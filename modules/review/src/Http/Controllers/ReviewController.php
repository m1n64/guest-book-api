<?php

namespace Modules\Review\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Responses\ApiJsonResponse;
use Modules\Review\Events\AddReplyEvent;
use Modules\Review\Events\AddReviewEvent;
use Modules\Review\Http\Requests\Reviews\ReplyRequest;
use Modules\Review\Http\Requests\Reviews\StoreRequest;
use Modules\Review\Http\Resources\ReplyResource;
use Modules\Review\Http\Resources\ReviewCollection;
use Modules\Review\Http\Resources\ReviewResource;
use Modules\Review\Models\Reply;
use Modules\Review\Models\Review;

class ReviewController extends Controller
{
    /**
     * @return ApiJsonResponse
     * @response ReviewCollection
     * @unauthenticated
     */
    public function index()
    {
        $reviews = Review::paginate(Review::PER_PAGE);

        return new ApiJsonResponse(
            data: new ReviewCollection($reviews),
        );
    }

    /**
     * @param StoreRequest $request
     * @return ApiJsonResponse
     * @response ReviewResource
     */
    public function store(StoreRequest $request)
    {
        $review = $request->user()
            ->reviews()
            ->create($request->only(['comment', 'rating']));

        event(new AddReviewEvent($review));

        return new ApiJsonResponse(
            data: ReviewResource::make($review),
        );
    }

    /**
     * @param ReplyRequest $request
     * @param Review $review
     * @return ApiJsonResponse
     * @response ReplyResource
     */
    public function reply(ReplyRequest $request, Review $review)
    {
        $reply = Reply::create([
            'user_id' => $request->user()->id,
            'review_id' => $review->id,
            'answer' => $request->answer,
        ]);

        broadcast(new AddReplyEvent($reply, $review));

        return new ApiJsonResponse(
            data: ReplyResource::make($reply),
        );
    }
}
