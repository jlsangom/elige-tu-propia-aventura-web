<?php

namespace Etpa\Tests\Domain;

use Etpa\Domain\Page;

class PageTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Etpa\Domain\NonExistingPageException
     */
    public function goFromPageWithNoTransitionsToOtherPageShouldThrowAnException()
    {
        (new Page())
            ->setId(1)
            ->setTitle('Page #1 title')
            ->setDescription('Page #1 description')
            ->goToPage(1);
    }

    /**
     * @test
     * @expectedException \Etpa\Domain\NonExistingPageException
     */
    public function goFromPageWithOneTransitionToOtherPageViaNonValidTransitionShouldThrowAnException()
    {
        $page = $this->createPage(1, 'Page #1 title', 'Page #1 description');
        $page->addPage($this->createPage(2, 'Page #2 title', 'Page #2 description'));
        $page->goToPage(1);
    }

    /**
     * @test
     */
    public function goFromPageWithOneTransitionToOtherPageViaValidTransitionShouldReturnDestinationPage()
    {
        $page = $this->createPage(1, 'Page #1 title', 'Page #1 description');
        $childPage = $this->createPage(2, 'Page #2 title', 'Page #2 description');
        $page->addPage($childPage);
        $this->assertSame($childPage, $page->goToPage(2));
    }

    /**
     * @test
     */
    public function goFromOnePageWithMoreThanOneTransitionToOtherPageViaValidTransitionShouldReturnDestinationPage()
    {
        $page = $this->createPage(1, 'Page #1 title', 'Page #1 description');
        $firstOptionPage = $this->createPage(2, 'Page #2 title', 'Page #2 description');
        $secondOptionPage = $this->createPage(3, 'Page #3 title', 'Page #3 description');
        $page->addPage($firstOptionPage);
        $page->addPage($secondOptionPage);
        $this->assertSame($firstOptionPage, $page->goToPage(2));
    }

    /**
     * @param $id
     * @param $title
     * @param $description
     * @return Page
     */
    public function createPage($id, $title, $description)
    {
        return (new Page)
            ->setId($id)
            ->setTitle($title)
            ->setDescription($description);
    }
}
