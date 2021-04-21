<?php


namespace WebmanPress\AutoRoute\Controller;


use support\Response;
use WebmanPress\AutoRoute\Attributes\Route;

class Swagger {
    #[Route('/swagger/{all:.+}')]
    public function getStaticFiles(
        $request,
        $path,
    ): Response {
        $file = realpath(dirname(__DIR__) . '/public/swagger/' . $path);
        if (is_file($file)) {
            return response('')->file($file);
        }

        return response('<h1>404</h1>')->withStatus(404);
    }

    #[Route('/swagger.json')]
    public function getDoc(): Response {
        return json(\WebmanPress\AutoRoute\Module\OpenAPI::generate());
    }


}