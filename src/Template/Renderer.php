<?php

namespace MagicFramework\Template;

use SebastianBergmann\Template\Template;

class Renderer
{
    /**
     * @var string
     */
    private $viewsDirectory;

    public function __construct(string $viewsDirectory)
    {
        $this->viewsDirectory = $viewsDirectory;
    }

    public function render(string $file, array $params = []): string
    {
        $template = new Template($this->viewsDirectory . $file);
        $template->setVar($params);

        return $template->render();
    }
}
