<?php namespace Rtablada\Images;

class ResizeAndPad implements \Imagine\Filter\FilterInterface
{
	/**
     * An ImagineInterface instance.
     *
     * @var ImagineInterface
     */
    protected $imagine;

    /**
     * Size for resizing
     *
     * @var \Imagine\Image\Box
     */
    protected $size;
    
    /**
     * Color for padding border
     * 
     * @var string
     */
    protected $color = '#fff';

    /**
     * Class constructor.
     *
     * @param ImagineInterface $imagine An ImagineInterface instance
     */
    public function __construct(\Imagine\Image\ImagineInterface $imagine = null)
    {
        $this->imagine = $imagine;
    }

    public function setSize($width, $height = null)
    {
    	if ($width instanceof \Imagine\Image\Box) {
    		$this->size = $width;
    	} else {
    		$this->size = new \Imagine\Image\Box($width, $height);
    	}

    	return $this;
    }

	public function apply(\Imagine\Image\ImageInterface $original)
	{
		$originalThumb = $original->thumbnail($this->size, 'inset');

		$image = $this->createCanvas();
		$image = $this->pasteCentered($image, $originalThumb);

		return $image;
	}
	
	public function setColor($color)
	{
		$this->color = $color;
	}

	protected function createCanvas()
	{
		$transparency = new \Imagine\Image\Color($this->color, 0);
		return $this->imagine->create($this->size, $transparency);
	}

	protected function pasteCentered(\Imagine\Image\ImageInterface $image, \Imagine\Image\ImageInterface $original)
	{
		$originalSize = $original->getSize();
		$x = $this->getPasteValue($this->size->getWidth(), $originalSize->getWidth());
		$y = $this->getPasteValue($this->size->getHeight(), $originalSize->getHeight());
		$pastePoint = new \Imagine\Image\Point($x, $y);

		$image->paste($original, $pastePoint);

		return $image;
	}

	protected function getPasteValue($targetValue, $originalValue)
	{
		return round(($targetValue - $originalValue) / 2);
	}
}
