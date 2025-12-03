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

    public function getCategoriesForCards(): Collection
    {
        return Categoria::where('ativo', true)
            ->orderBy('ordem')
            ->get()
            ->map(function ($categoria) {
                return [
                    'id' => $categoria->id,
                    'nome' => $categoria->nome,
                    'slug' => $categoria->slug,
                    'icone' => $categoria->icone,
                    'descricao' => $categoria->descricao,
                    'quantidade_servicos' => $categoria->servicos()
                        ->where('status', 'ativo')
                        ->where('verificado', true)
                        ->count(),
                ];
            });
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

    public function getCategoryBySlug(?string $slug = null): ?Categoria
    {
        if (!$slug) {
            return null;
        }

        return Categoria::where('slug', $slug)->first();
    }

    public function getCategoriesWithServiceCount(int $limit = 10): Collection
    {
        return Categoria::withCount(['servicos' => function ($query) {
            $query->where('status', 'ativo')->where('verificado', true);
        }])
            ->where('ativo', true)
            ->orderBy('servicos_count', 'desc')
            ->limit($limit)
            ->get();
    }

    public function searchCategories(string $term, int $limit = 10): Collection
    {
        return Categoria::where('ativo', true)
            ->where(function ($query) use ($term) {
                $query->where('nome', 'LIKE', "%{$term}%")
                    ->orWhere('descricao', 'LIKE', "%{$term}%")
                    ->orWhere('slug', 'LIKE', "%{$term}%");
            })
            ->orderBy('ordem')
            ->limit($limit)
            ->get();
    }
}
