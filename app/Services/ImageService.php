<?php

/** Image Service
 * Resize and Save pictures
 */
class ImageService
{
    private $image_file;

    public $image;
    public $image_type;
    public $image_width;
    public $image_height;

    public function __construct($image_file)
    {
        $this->image_file = $image_file;
        $image_info = getimagesize($this->image_file);
        $this->image_width = $image_info[0];
        $this->image_height = $image_info[1];
        switch ($image_info[2]) {
            case 1:
                $this->image_type = 'gif';
                break;//1: IMAGETYPE_GIF
            case 2:
                $this->image_type = 'jpeg';
                break;//2: IMAGETYPE_JPEG
            case 3:
                $this->image_type = 'png';
                break;//3: IMAGETYPE_PNG
        }
        $this->fotoimage();
    }

    private function fotoimage()
    {
        switch ($this->image_type) {
            case 'gif':
                $this->image = imagecreatefromgif($this->image_file);
                break;
            case 'jpeg':
                $this->image = imagecreatefromjpeg($this->image_file);
                break;
            case 'png':
                $this->image = imagecreatefrompng($this->image_file);
                break;
        }
    }

    public function autoimageresize($new_w, $new_h)
    {
        $difference_w = 0;
        $difference_h = 0;
        if ($this->image_width < $new_w && $this->image_height < $new_h) {
            $this->imageresize($this->image_width, $this->image_height);
        } else {
            if ($this->image_width > $new_w) {
                $difference_w = $this->image_width - $new_w;
            }
            if ($this->image_height > $new_h) {
                $difference_h = $this->image_height - $new_h;
            }
            if ($difference_w > $difference_h) {
                $this->imageresizewidth($new_w);
            } elseif ($difference_w < $difference_h) {
                $this->imageresizeheight($new_h);
            } else {
                $this->imageresize($new_w, $new_h);
            }
        }
    }

    public function imageresizewidth($new_w)
    {
        $new_h = $this->image_height * ($new_w / $this->image_width);
        $this->imageresize($new_w, $new_h);
    }

    public function imageresizeheight($new_h)
    {
        $new_w = $this->image_width * ($new_h / $this->image_height);
        $this->imageresize($new_w, $new_h);
    }

    public function imageresize($new_w, $new_h)
    {
        $new_image = imagecreatetruecolor($new_w, $new_h);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $new_w, $new_h, $this->image_width, $this->image_height);
        $this->image_width = $new_w;
        $this->image_height = $new_h;
        $this->image = $new_image;
    }

    public function imagesave($image_file)
    {
        switch ($this->image_type) {
            case 'gif':
                imagegif($this->image, $image_file);
                break;
            case 'jpeg':
                imagejpeg($this->image, $image_file, 100);
                break;
            case 'png':
                imagepng($this->image, $image_file);
                break;
        }
    }

    public function imageout()
    {
        imagedestroy($this->image);
    }

    public static function getImage($filename)
    {
        return "storage/image/" . $filename;
    }

}