<?php

namespace App\GraphQL\Queries;
use App\Models\Blog;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class BlogQuery extends Query
{
    protected $attributes = [
        "name" => "blog",
    ];

    public function type(): Type
    {
        return GraphQL::type("Blog");
    }
    
    public function args(): array
    {
        return[
            "id" => [
                "name" => "id",
                "type" => Type::int(),
                "rules" => ["required"],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Blog::findOrFail($args["id"]);
    }
}