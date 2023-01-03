<?php

declare(strict_types=1);

namespace Application\Api\Post;

use Shared\ApiController;
use Illuminate\Http\Request;
use Domain\Post\Actions\PostWithUserFinderAction;
use Domain\Post\DataTransferObjects\FindPostData;

class PostGetController extends ApiController
{
    public function __construct(
        private PostWithUserFinderAction $postWithUserfinder
    ) {
    }

    public function __invoke(Request $request, string $id)
    {
        $findPostWithUserData = new FindPostData($id);

        $postResource = $this->postWithUserfinder->__invoke($findPostWithUserData);

        return response()->json($postResource);
    }
}
