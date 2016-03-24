<?php

namespace Romalytvynenko\Blog;

/**
 * Trait Writer
 * @package Romalytvynenko\Blog
 *
 * Trait for user's model, add writer functionality
 */
trait Writer
{
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    /**
     * Is user has posts?
     *
     * @return bool
     */
    public function hasPosts()
    {
        return (bool)($this->posts()->count() > 0);
    }
}