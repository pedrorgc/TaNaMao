<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Support\Collection;

class CategoriaService
{
    public function getActiveCategories(): Collection
    {
        return Categoria::where('ativo', true)
            ->orderBy('ordem')
            ->orderBy('nome')
            ->get();
    }

    public function getFeaturedCategories(int $limit = 4): Collection
    {
        return Categoria::where('ativo', true)
            ->orderBy('ordem')
            ->orderBy('nome')
            ->limit($limit)
            ->get();
    }

    public function getCategoriesForCards($limit = 8)
    {
        return Categoria::where('ativo', true)
            ->orderBy('ordem')
            ->orderBy('nome')
            ->limit($limit)
            ->get();
    }

    public function getAllActiveCategories()
    {
        return Categoria::where('ativo', true)
            ->orderBy('ordem')
            ->orderBy('nome')
            ->get();
    }

    public function formatCategoriesForSelector(): Collection
    {
        return $this->getActiveCategories()->map(function ($category) {
            return [
                'name' => $category->nome,
                'href' => "/categorias/{$category->slug}",
            ];
        });
    }

    public function formatCategoriesForDisplay(): Collection
    {
        return $this->getActiveCategories()->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->nome,
                'icon' => $category->icone,
                'description' => $category->descricao,
                'slug' => $category->slug,
            ];
        });
    }

    public function getCategoryBySlug(?string $slug): ?Categoria
    {
        if (empty($slug)) {
            return null;
        }

        return Categoria::where('slug', $slug)
            ->where('ativo', true)
            ->first();
    }
}