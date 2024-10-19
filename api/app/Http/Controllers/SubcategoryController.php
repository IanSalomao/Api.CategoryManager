<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    // Listar todas as subcategorias de uma categoria específica
    public function index($categoryId)
    {
    $subcategorys = DB::table('subcategorys')
                    ->join('categorys', 'subcategorys.id_category', '=', 'categorys.id_category') // Corrigido o nome da tabela
                    ->where('categorys.id_category', $categoryId)
                    ->where('categorys.id_user', auth()->user()->id_user)
                    ->select('subcategorys.*')
                    ->get();

    return response()->json($subcategorys, 200);

    }

    // Criar uma nova subcategoria
    public function store(Request $request, $categoryId)
    {
        $category = Category::where('id_category', $categoryId)
                            ->where('id_user', auth()->user()->id_user)
                            ->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subcategory = SubCategory::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'id_category' => $categoryId
        ]);

        return response()->json($subcategory, 201);
    }

    // Atualizar uma subcategoria existente
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $subcategory = Subcategory::where('id_subcategory', $id)
                                  ->whereHas('category', function ($query) {
                                      $query->where('id_user', auth()->user()->id_user);
                                  })
                                  ->firstOrFail();

        $subcategory->update($validated);

        return response()->json($subcategory, 200);
    }

    // Excluir uma subcategoria
    public function destroy($id)
    {
        $subcategory = Subcategory::where('id_subcategory', $id)
                                  ->whereHas('category', function ($query) {
                                      $query->where('id_user', auth()->user()->id_user);
                                  })
                                  ->firstOrFail();

        $subcategory->delete();

        return response()->json(['message' => 'Subcategoria deletada com sucesso'], 200);
    }
}
