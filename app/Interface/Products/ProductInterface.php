<?php

namespace App\Interface\Products;

interface ProductInterface
{
    public function index();
    public function store($request);
    public function show($id);
    public function update($request, $id);
}
