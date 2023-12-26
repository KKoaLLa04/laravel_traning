<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Categories extends Controller
{
    public function index()
    {
        return "INDEX category";
    }

    // Lay chi tiet danh muc theo id
    public function getCategory($id)
    {
        return "Chi tiet danh muc - " . $id;
    }

    // đổ dữ liệu ra formm
    public function editCategory($id)
    {
        return "UPDATE danh muc - " . $id;
    }

    public function updateCategory($id)
    {
        return "Xu ly update";
    }

    public function addCategory()
    {
        return view("clients/categories/add");
    }

    public function handleAddCategory()
    {
        return "Xu ly them du lieu";
    }

    public function deleteCategory($id)
    {
        return "Xoa chuyen muc - " . $id;
    }
}
