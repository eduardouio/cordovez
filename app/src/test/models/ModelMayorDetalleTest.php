<?php
require_once 'src/models/ModelMayorDetalle.php';

use PHPUnit\Framework\TestCase;

/**
 * ModelMayorDetalle test case.
 */
class ModelMayorDetalleTest extends TestCase
{

    /**
     *
     * @var ModelMayorDetalle
     */
    private $modelMayorDetalle;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();

        // TODO Auto-generated ModelMayorDetalleTest::setUp()

        $this->modelMayorDetalle = new ModelMayorDetalle(/* parameters */);
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        // TODO Auto-generated ModelMayorDetalleTest::tearDown()
        $this->modelMayorDetalle = null;

        parent::tearDown();
    }

    /**
     * Constructs the test case.
     */
    public function __construct()
    {
        // TODO Auto-generated constructor
    }

    /**
     * Tests ModelMayorDetalle->__construct()
     */
    public function test__construct()
    {
        // TODO Auto-generated ModelMayorDetalleTest->test__construct()
        $this->markTestIncomplete("__construct test not implemented");

        $this->modelMayorDetalle->__construct(/* parameters */);
    }

    /**
     * Tests ModelMayorDetalle->get()
     */
    public function testGet()
    {
        // TODO Auto-generated ModelMayorDetalleTest->testGet()
        $this->markTestIncomplete("get test not implemented");

        $this->modelMayorDetalle->get(/* parameters */);
    }

    /**
     * Tests ModelMayorDetalle->getByMayor()
     */
    public function testGetByMayor()
    {
        // TODO Auto-generated ModelMayorDetalleTest->testGetByMayor()
        $this->markTestIncomplete("getByMayor test not implemented");

        $this->modelMayorDetalle->getByMayor(/* parameters */);
    }

    /**
     * Tests ModelMayorDetalle->deleteFromMayor()
     */
    public function testDeleteFromMayor()
    {
        // TODO Auto-generated ModelMayorDetalleTest->testDeleteFromMayor()
        $this->markTestIncomplete("deleteFromMayor test not implemented");

        $this->modelMayorDetalle->deleteFromMayor(/* parameters */);
    }

    /**
     * Tests ModelMayorDetalle->delete()
     */
    public function testDelete()
    {
        // TODO Auto-generated ModelMayorDetalleTest->testDelete()
        $this->markTestIncomplete("delete test not implemented");

        $this->modelMayorDetalle->delete(/* parameters */);
    }
}

