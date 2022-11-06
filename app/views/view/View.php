<?php
declare(strict_types=1);

namespace app\views\view;

class View 
{
    private $layout = "default";
    private $title = "";

    public function __construct(array $config = [], string $layout, string $title)
    {
        $this->layout = $layout;
        $this->title = $title;
    }   

    public function render(array $views = [], array $vars = [], $title = "") : void
    {
        extract($vars);

        $styles = (!empty($styles)) ? $styles : [];
        $scripts = (!empty($scripts)) ? $scripts : [];

        $styles = $this->getStyles($styles);
        $scripts = $this->getScripts($scripts);
        $layout = $this->layout;
        $title = (!empty($title)) ? $title : $this->title;

        ob_start();
        foreach ($views as $view)
        {
            $path = DIR . '/app/views/' . ucfirst($view) . 'View.php';

            if (file_exists($path)) require $path;
        }
        $content = ob_get_contents();
        ob_clean();

        $path = DIR . '/app/views/layouts/' . ucfirst($layout) . 'Layout.php';

        if (file_exists($path)) require $path;
    }

    public function getStyles(array $styles = []) : string
    {
        $result = "";

        foreach ($styles as $style)
        {
            $result .= "<link rel='stylesheet' href='/app/assets/styles/" . $style . ".css'>\n";
        }

        return $result;
    }

    public function getScripts(array $scripts = []) : string
    {
        $result = "";

        foreach ($scripts as $script)
        {
            $result .= "<script src='/app/assets/scripts/" . $script . ".js' defer></script>\n";
        }

        return $result;
    }

    public function message($type = 'message', $message)
    {
        echo json_encode(['type' => $type, 'message' => $message]);
        exit;
    }

    public function js_redirect(string $url, $type = 'redirect', $message = [])
    {
        echo json_encode(['type' => $type, 'url' => $url, 'message' => $message]);
        exit;
    }
}