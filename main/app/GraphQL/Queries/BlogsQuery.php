<?php

namespace App\GraphQL\Queries;
use AppBlog;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class BlogsQuery extends Query
{
    protected $attributes = [
        "name" => "blogs",
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type("Blog"));
    }

    public function resolve($root, $args)
    {
        return Blog::all();
    }
}