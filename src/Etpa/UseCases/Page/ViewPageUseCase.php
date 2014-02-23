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

    public function viewPage($request)
    {
        $page = $this->pageRepository->find($request->id);

        $response = new Response();
        $response->page = $page;

        return $response;
    }
}
