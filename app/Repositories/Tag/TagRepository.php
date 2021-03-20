<?php

namespace App\Repositories\Tag;

use App\Models\Tag;
use App\Repositories\BaseRepository;
use App\Repositories\Tag\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Tag::class;
    }

    public function getTagActive($key, $value)
    {
        return $this->_model->where([
            [$key, '=', $value],
            ['status', '=', '1']
        ])->first();
    }
}
