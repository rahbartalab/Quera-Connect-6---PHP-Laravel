<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Minifier
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if ($response instanceof Response && str_contains($response->headers->get('Content-Type'), 'text/html')) {
            $output = $response->getContent();
            $output = $this->minifyHtml($output);
            $response->setContent($output);
        }
        return $response;
    }

    function minifyHTML($htmlString): array|string|null
    {
        $replace = [
            '<!--(.*?)-->' => '', //remove comments
            "/<\?php/" => '<?php ',
            "/\n([\S])/" => '$1',
            "/\r/" => '', // remove carriage return
            "/\n/" => '', // remove new lines
            "/\t/" => '', // remove tab
            "/\s+/" => ' ', // remove spaces
        ];
        return preg_replace(array_keys($replace), array_values($replace), $htmlString);
    }
}
