<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\ViteAssetExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ViteAssetExtension extends AbstractExtension
{
    public function __construct(
        private readonly bool $isDev,
        private readonly string $devServerHost,
        private readonly string $manifestPath,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('vite_entry_script_tags', [$this, 'renderViteScriptTags'], ['is_safe' => ['html']]),
        ];
    }

    public function renderViteScriptTags(string $entrypoint): string
    {
        return $this->isDev ? $this->generateViteScriptTagsDev($entrypoint) : $this->generateViteScriptTagsProd($entrypoint);
    }

    private function generateViteScriptTagsDev(string $entrypoint): string
    {
        $port = $this->devServerHost;

        return "
            <script type=\"module\" src=\"http://localhost:$port/build/@vite/client\"></script>
            <script type=\"module\" src=\"http://localhost:$port/build/$entrypoint\"></script>
        ";
    }

    private function generateViteScriptTagsProd(string $entrypoint): string
    {
        $manifest = json_decode(file_get_contents($this->manifestPath), true, 512, JSON_THROW_ON_ERROR);

        $entrypointFiles = $manifest['entrypoints'][$entrypoint]['js'];
        $scriptTags = array_map(fn (string $file) => sprintf('<script type="module" src="%s"></script>', $file), $entrypointFiles);

        return implode("\n", $scriptTags);
    }
}
