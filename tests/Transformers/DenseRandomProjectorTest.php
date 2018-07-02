<?php

namespace Rubix\Tests\Transformers;

use Rubix\ML\Datasets\Unlabeled;
use Rubix\ML\Transformers\Transformer;
use Rubix\ML\Transformers\DenseRandomProjector;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class DenseRandomProjectorTest extends TestCase
{
    protected $transformer;

    protected $dataset;

    public function setUp()
    {
        $this->dataset = new Unlabeled([
            [1, 2, 3, 4],
            [40, 20, 30, 10],
            [100, 300, 200, 400],
        ]);

        $this->transformer = new DenseRandomProjector(2);
    }

    public function test_build_l1_regularizer()
    {
        $this->assertInstanceOf(DenseRandomProjector::class, $this->transformer);
        $this->assertInstanceOf(Transformer::class, $this->transformer);
    }

    public function test_transform_fitted()
    {
        $this->transformer->fit($this->dataset);

        $this->dataset->apply($this->transformer);

        $this->assertEquals(2, $this->dataset->numColumns());
    }

    public function test_transform_unfitted()
    {
        $this->expectException(RuntimeException::class);

        $this->dataset->apply($this->transformer);
    }
}