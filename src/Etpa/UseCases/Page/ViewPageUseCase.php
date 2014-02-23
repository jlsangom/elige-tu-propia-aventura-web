<?php

namespace Etpa\UseCases\Page;

class ViewPageUseCase
{
    /**
     * @var \Etpa\Domain\PageRepository
     */
    private $pageRepository;

    public function __construct($pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * @param ViewPageRequest $request
     * @return ViewPageResponse
     */
    public function viewPage($request)
    {
        return $this->createResponse(
            $this->tryFindPageById($request)
        );
    }

    /**
     * @param $page
     * @return ViewPageResponse
     */
    private function createResponse($page)
    {
        $response = new ViewPageResponse();
        $response->page = $page;

        return $response;
    }

    /**
     * @param ViewPageRequest $request
     * @throws PageRepositoryNotAvailableException
     * @throws PageDoesNotExistException
     * @return mixed
     */
    private function tryFindPageById($request)
    {
        try {
            $page = $this->pageRepository->find($request->pageId);
        } catch(\Exception $e) {
            throw new PageRepositoryNotAvailableException();
        }

        if (!$page) {
            throw new PageDoesNotExistException();
        }

        return $page;
    }
}
