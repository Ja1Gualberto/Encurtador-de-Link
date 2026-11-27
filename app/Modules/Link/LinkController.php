<?php

namespace App\Modules\Link;

use App\Http\Controllers\Controller;
use App\Modules\Link\dto\CreateLink;
use Illuminate\Http\JsonResponse;

class LinkController extends Controller
{
  public function __construct(
    private LinkService $service,
  ){}
  
  public function cadastrar(CreateLink $request)
  {
    $result = $this->service->cadastrar($request->validated());
    
    return $result;
  }
}
