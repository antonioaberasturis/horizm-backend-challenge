<?php

declare(strict_types=1);

namespace Application\Api\Post;

use Shared\ApiController;
use Illuminate\Http\Request;
use Domain\Post\Actions\PostWithUserFinderAction;
use Domain\Post\DataTransferObjects\FindPostData;
use Domain\Post\Resources\PostByIdResource;

class PostGetController extends ApiController
{
    public function __construct(
        private PostWithUserFinderAction $postWithUserfinder
    ) {
    }

    public function __invoke(Request $request, string $id)
    {
        $findPostWithUserData = new FindPostData($id);

        $post = $this->postWithUserfinder->__invoke($findPostWithUserData);

        return response()->json(new PostByIdResource($post));
    }
}
