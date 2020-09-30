<?php

namespace App\Core;

class View
{
    public const VIEW_PATH = BP . DIRECTORY_SEPARATOR . 'view';
    public function render(string $template, array $args = []): string
    {
        $templateFileName = $this->getTemplateFileName($template);

        ob_start();
        try {
            extract($this->modifyArgs($args), EXTR_SKIP);
            include $templateFileName;
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }
        return ob_get_clean() ?: '';
    }
    protected function getTemplateFileName(string $template): string
    {
        return self::VIEW_PATH . DIRECTORY_SEPARATOR . $template . '.phtml';
    }

    protected function modifyArgs(array $args): array
    {
        $args['currentUser'] = Auth::getInstance()->getCurrentUser();
        return $args;
    }
}