<?php

namespace App\Http\Controllers;

use App\Repositories\LinkRepository;
use Illuminate\Http\Request;

class LinkController extends Controller
{

    protected $repository;

    public function __construct(LinkRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $types = $this->repository->getDiscountType();
        return view('layout_admin.link.index', compact('types'));
    }
}
