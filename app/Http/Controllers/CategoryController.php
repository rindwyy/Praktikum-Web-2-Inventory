<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\CategoryService;
use App\Http\Controllers\Api\BaseController;
use Exception;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
        protected CategoryService $svc;

    // Tambahkan kembali kode constructor ini:
    public function __construct(CategoryService $svc)
    {
        $this->svc = $svc;
    }


    // Inject CategoryService melalui Constructor
    public function index(): JsonResponse
  {
      return $this->success($this->svc->all(), 'Berhasil menarik semua data Kategori');
  }

  public function store(StoreCategoryRequest $req): JsonResponse
  {
      $cat = $this->svc->create($req->validated());
      return $this->success($cat, 'Kategori berhasil dibuat', 201);
  }

  public function show($id): JsonResponse
  {
      try {
          $cat = $this->svc->find($id);
          return $this->success($cat, 'Berhasil menarik satu data kategori');
      } catch (Exception $e) {
          return $this->error($e->getMessage(), null, 404);
      }
  }

  public function update(UpdateCategoryRequest $req, $id): JsonResponse
  {
      $cat = $this->svc->update($id, $req->validated());
      return $this->success($cat, 'Kategori berhasil diperbarui');
  }

  public function destroy($id): JsonResponse
  {
      $this->svc->delete($id);
      return $this->success(null, 'Kategori berhasil dihapus');
  }
}