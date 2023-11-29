<?php

namespace WebhooksManager\AcfFields\Test;

use PHPUnit\Framework\MockObject\MockObject;
use WebhooksManager\AcfFields\FieldOptionsModifier;
use WebhooksManager\Options\OptionsInterface;
use WP_Mock\Tools\TestCase;

class FieldsModifierTest extends TestCase
{
    public function testActionsFieldGetsPopulatedByActionsFromOptions()
    {
        // Given
        $_GET['page']   = 'webhooks-manager';
        $mockOptions    = $this->getMockOptions();
        $fieldsModifier = new FieldOptionsModifier($mockOptions);
        $actions        = ['test'];
        $field          = ['choices' => []];
        $mockOptions->method('getActions')->willReturn($actions);

        // When
        $modifiedField = $fieldsModifier->getActionFieldOptions($field);

        // Then
        $this->assertEquals(['test' => 'test'], $modifiedField['choices']);
    }

    public function testHttpMethodFieldGetsPopulatedByMethodsFromOptions()
    {
        // Given
        $_GET['page']   = 'webhooks-manager';
        $mockOptions    = $this->getMockOptions();
        $fieldsModifier = new FieldOptionsModifier($mockOptions);
        $methods        = ['test'];
        $field          = ['choices' => []];
        $mockOptions->method('getHttpMethods')->willReturn($methods);

        // When
        $modifiedField = $fieldsModifier->getHttpMethodFieldOptions($field);

        // Then
        $this->assertEquals(['test' => 'test'], $modifiedField['choices']);
    }

    private function getMockOptions(): MockObject|OptionsInterface
    {
        return $this->getMockBuilder(OptionsInterface::class)->getMock();
    }
}
