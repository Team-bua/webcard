<?php

namespace App\Repositories;

use App\Models\CardType;
use Illuminate\Support\Str;

class LinkRepository
{
    /**
     * Get member collection paginate.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */

    public function getDiscountType()
    {
       return CardType::all();
    }

}