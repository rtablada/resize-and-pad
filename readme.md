Resize And Pad
---

This is a simple Imagine Filter to allow you to resize and pad images with whitespace to ensure consistent sizing without cropping or stretching.

## Installing

Add `"rtablada/resize-and-pad": "dev-master"` to your `composer.json` file.

## Use

Using this filter is quite similar to the Transformation Filter in Imagine.
Inject your instance of Imagine and then call `setSize`.
Here we will use a GD instance, but any instance of `Imagine\Image\ImageInterface` will do.

```php
$imagine = new \Imagine\GD\Imagine;
$resizer = new \Rtablada\Images\ResizeAndPad($imagine);
$image = $imagine->open($pathToImage);

$resizer->setSize(200, 200);
$output = $resizer->apply($image);
$output->save($outputPath);
```

The `setSize` and `apply` functions allow for chaining so the above could be written like this:

```php
$resizer->setSize(200, 200)->apply($image)->save($outputPath);
```

## Use with Stapler

This Filter was originally built for use within a Laravel project using [Stapler](https://github.com/CodeSleeve/stapler).
Using this filter with Stapler is quite simple when defining your styles:

```php
$this->hasAttachedFile('avatar', [
	'styles' => [
		'medium' => '300x300',
		'thumb' => function($file, $imagine) {
			$resizer = \Rtablada\Images\ResizeAndPad($imagine);
			return $resizer->setSize(100,100)->apply($file);
		}
	]
]);
```
