<?php

namespace WebhooksManager\Options\Test;

use PHPUnit\Framework\TestCase;
use WebhooksManager\Options\Options;

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

    /**
     * @testdox getPostActions() applies filter for modifying result.
     */
    public function testGetActionsReturnsArrayAppliesFilterForModifyingResult()
    {
        $this->markTestIncomplete();
    }

    public function testGetTypeLabelsReturnsExpectedLabels()
    {
        $options    = new Options();
        $typeLabels = $options->getTypeLabels();

        $this->assertIsObject($typeLabels);
        $this->assertObjectHasProperty('cron', $typeLabels);
        $this->assertObjectHasProperty('post', $typeLabels);
    }
}
