<?php

namespace App\Http\Controllers;

use App\Models\AttributeGroup;
use Illuminate\Http\Request;

class AttributeGroupController extends Controller
{
    public function index ()
    {
        $attributeGroups = AttributeGroup::where("status", 1)->get();
        return view("admin.product_attribute_groups.index", compact('attributeGroups'));
    }
}
