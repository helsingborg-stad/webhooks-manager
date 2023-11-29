<?php

namespace WebhooksManager\Test;

use WebhooksManager\Options;
use WP_Mock;
use WP_Mock\Tools\TestCase;

class OptionsTest extends TestCase
{
    public function testGetHttpMethodsContainsExpectedMethods()
    {
        $options     = new Options();
        $httpMethods = $options->getHttpMethods();
        $this->assertIsArray($httpMethods);
        $this->assertContains('GET', $httpMethods);
        $this->assertContains('POST', $httpMethods);
    }

    public function testGetActionsReturnsArray()
    {
        $options = new Options();
        $this->assertIsArray($options->getActions());
    }

    public function testGetActionsReturnsDefaultActions()
    {
        $options = new Options();
        $this->assertEquals(Options::DEFAULT_ACTIONS, $options->getActions());
    }

    public function testGetActionsReturnsArrayAppliesFilterForModifyingResult()
    {
        WP_Mock::onFilter('WebhooksManager\Options\getActions')
            ->with(Options::DEFAULT_ACTIONS)
            ->reply(['test']);

        $options = new Options();
        $this->assertEquals(['test'], $options->getActions());
    }
}
