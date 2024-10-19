<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Listar todas as categorias e subcategorias do usuário autenticado
    public function index()
    {
        $user = auth()->user();
        $categories = Category::where('id_user', $user->id_user)->get();

        return response()->json($categories, 200);
    }

    // Criar uma nova categoria
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'id_user' => auth()->user()->id_user,
        ]);

        return response()->json($category, 200);
    }

    // Atualizar uma categoria existente
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::where('id_category', $id)
                            ->where('id_user', auth()->user()->id_user)
                            ->firstOrFail();

        $category->update($validated);

        return response()->json($category, 200);
    }

    // Excluir uma categoria (e suas subcategorias em cascata)
    public function destroy($id)
    {
        $category = Category::where('id_category', $id)
                            ->where('id_user', auth()->user()->id_user)
                            ->firstOrFail();

        $category->delete();

        return response()->json(['message' => 'Categoria deletada com sucesso'], 200);
    }
}
