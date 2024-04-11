<?php

namespace WebhooksManager\Options\Test;

use WebhooksManager\Options\Options;
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

    public function testGetActionsReturnsIterableArray()
    {
        $options = new Options();
        $this->assertIsArray($options->getPostActions());
        $this->assertNotEmpty($options->getPostActions());
        $this->assertIsIterable($options->getPostActions());
    }

    public function testGetPostActionsReturnsDefaultActions()
    {
        $options = new Options();
        $this->assertArrayHasKey('post_updated', $options->getPostActions()); 
        $this->assertArrayHasKey('post_created', $options->getPostActions());
        $this->assertArrayHasKey('post_deleted', $options->getPostActions());
    }

    //TODO: Fix failing test.
    /*public function testGetActionsReturnsArrayAppliesFilterForModifyingResult()
    {
        WP_Mock::onFilter('WebhooksManager\Options\getPostActions')
            ->with([])
            ->reply(['testkey'=> 'test']);
        $options = new Options();
        $this->assertArrayHasKey('testkey', $options->getPostActions());
    }*/ 


    public function testGetTypeLabelsReturnsExpectedLabels()
    {
        $options = new Options();
        $typeLabels = $options->getTypeLabels();

        $this->assertIsObject($typeLabels);
        $this->assertObjectHasProperty('cron', $typeLabels);
        $this->assertObjectHasProperty('post', $typeLabels);
    }
}
