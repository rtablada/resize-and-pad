<?php

class ResizeAndPadTest extends \PHPUnit_Framework_TestCase
{
	public function setup()
	{
		$this->imagine = new \Imagine\Gd\Imagine;
		$this->blackBox = $this->imagine->open(__DIR__.'/images/black.jpg');
		$this->resizer = new \Rtablada\Images\ResizeAndPad($this->imagine);
	}

	public function testVerticalCenter()
	{
		$this->resizer->setSize(10,20);
		$output = $this->resizer->apply($this->blackBox)->save(__DIR__.'/images/verticalCenter.jpg');
	}

	public function testHorizontalCenter()
	{
		$this->resizer->setSize(20,10);
		$output = $this->resizer->apply($this->blackBox)->save(__DIR__.'/images/horizontalCenter.jpg');
	}
}
