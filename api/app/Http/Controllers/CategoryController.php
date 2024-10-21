<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

public function getCategoriesWithSubcategories(Request $request)
    {
    // Obtém o ID do usuário autenticado
    $userId =  auth()->user()->id_user;

    // Consulta SQL explícita para buscar categorias e subcategorias do usuário
    $categories = DB::select("
        SELECT c.id_category, c.name,c.description,
               (SELECT JSON_ARRAYAGG(JSON_OBJECT('id', s.id_subcategory, 'name', s.name))
                FROM subcategorys s
                WHERE s.id_category = c.id_category) AS subcat
        FROM categorys c
        WHERE c.id_user = ?
    ", [$userId]);

    // Decodifica o JSON das subcategorias e retorna os dados
    $result = array_map(function($category) {
        // Decodifica a string JSON para um array
         $category->subcat = $category->subcat ? json_decode($category->subcat) : [];

        return $category;
    }, $categories);


    // Retorna os dados em formato JSON
    return response()->json($result);
    }

}
