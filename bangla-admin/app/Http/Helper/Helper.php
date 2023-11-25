<?php

namespace App\Http\Helper;

use App\Http\Repositories\HelperRepositoryInterface;
use App\Models\District;
use App\Models\Division;
use App\Models\Thana;
// use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;

class Helper implements HelperRepositoryInterface
{

    /**
     * @param $image
     * @param $date
     * @return string
     */
    public function imageUpload($image, $date = "Y-m-d", $waterMark = false): string
    {
        $file = $image;
        $ogImage = Image::make($file);

        if ($waterMark) {
            $imageName = time() . "-watermark-" . $file->getClientOriginalName();
            $ogImage->resize(600, null)->insert('watermark.jpg', 'bottom-right');
        } else {
            $imageName = time() . $file->getClientOriginalName();
        }

        $folder = public_path('/images/' . $date . '/');

        if (!File::exists($folder)) {
            File::makeDirectory($folder, 0775, true, true);
        }

        $originalPath = $folder . $imageName;
        $returnPath = '/images/' . $date . '/' . $imageName;
        $ogImage =  $ogImage->save($originalPath);
        return URL::to('/') . $returnPath;
    }

    public function deleteImage($image): void
    {
        $image_path = public_path(str_replace(URL::to('/'), "", $image));
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
    }



    public function getDivsions()
    {
        $divisions = Division::get();
        return $divisions;
    }

    public function getDistrictByDivision($divId)
    {
        $districs = District::where('division_id', $divId)->get();
        return $districs;
    }

    public function getUpozillaByDistrict($upoId)
    {
        $upozillas = Thana::where('district_id', $upoId)->get();
        return $upozillas;
    }
}
