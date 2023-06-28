<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Models\Category;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Entity $entity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entity $entity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entity $entity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entity $entity)
    {
        //
    }

    public function importEntitiesFromApi(ApiService $apiService)
    {
        $entities = $apiService->getEntities();
        
        $animalsCategory = Category::where('category', 'Animals')->first();
        $securityCategory = Category::where('category', 'Security')->first();        
        
        $existingLinks = Entity::existingLinks();
        
        $importedCount = 0;
        $notImportedCount = 0;
        
        foreach ($entities as $entity) {
            if ($entity['Category'] === 'Animals' || $entity['Category'] === 'Security') { 
                //evito que se inserten 2 veces, utilizo el atributo link, ya que creo que es un valor único para cada registro
                if (!in_array($entity['Link'], $existingLinks)){
                    Entity::create([
                        'api' => $entity['API'],
                        'description' => $entity['Description'],
                        'link' => $entity['Link'],
                        'category_id' => $entity['Category'] === 'Animals' ? $animalsCategory->id : $securityCategory->id,
                    ]);
                    $importedCount++;
                }else{
                    $notImportedCount++;
                }
            }
        }
        
        return response()->json([
            'message' => 'Proceso finalizado',
            'imported_count' => $importedCount,
            'not_imported_count' => $notImportedCount,
            'total_count' => $notImportedCount + $importedCount
        ]);
    }
}
