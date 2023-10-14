<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BannerRepositoryInterface;
use App\Models\Banner;

class BannerRepository implements BannerRepositoryInterface
{
protected function __construct(protected Banner $banner){}



    public function getModel(): mixed
    {
        return $this->model;
    }
}
