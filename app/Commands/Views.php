<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Views extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'App';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'views:manage';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'This command creates or deletes Views and their corresponding SCSS and JS files.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'views:manage [create|delete] [options eg. name=example type=widgets Note you can define no type if you inteded to use something as a global file]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [
        'command' => 'The action to perform: create or delete views and their corresponding files.',
    ];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [
        'name' => 'The name of the view file to create or delete.',
        'type' => 'The type of the view file (widgets, templates, partials, pages). Defaults to the parent directory.',
    ];

    /**
     * Actually execute a command.
     *
     * @param array $params
     */

    public function run(array $params)
    {
        // Validate and extract parameters
        $command = $params[0] ?? null;
        $name = $this->extractParam($params, 'name');
        $type = $this->extractParam($params, 'type');

        if (!$command || !$name) {
            CLI::error('You must provide a command (create|delete) and a name for the view.');
            return;
        }

        // Determine the target directories
        $directories = $this->getDirectories($type);
        $viewFile = $directories['view'] . $name . '.php';
        $scssFile = $directories['scss'] . $name . '.scss';
        $jsFile = $directories['js'] . $name . '.js';

        // Handle create or delete commands
        if ($command === 'create') {

            $this->createFile($viewFile, ($name === 'scripts' || $name === 'styles' || $name === 'default' ) || ($type === 'partials') ? '' : "<div class=\"{$name}\" id=\"{$name}\" data-target=\"{$name}\">\n\n</div>");
            $this->createFile($scssFile, ".{$name} {\n    // Add your styles here\n}");
            $this->createFile($jsFile, "var {$name} = {\n    init: function() {\n        // Initialize your script here\n    }\n};");
        
        } elseif ($command === 'delete') {

            $this->deleteFile($viewFile);
            $this->deleteFile($scssFile);
            $this->deleteFile($jsFile);
            
        } else {
            CLI::error("Invalid command '{$command}'. Use 'create' or 'delete'.");
        }
    }

    /**
     * Extract a parameter from the input array.
     *
     * @param array $params
     * @param string $key
     * @return string|null
     */

    private function extractParam(array $params, string $key): ?string
    {
        foreach ($params as $param) {
            if (preg_match("/^{$key}=(.+)$/", $param, $matches)) {
                return $matches[1];
            }
        }
        // If 'type' is not provided, return null without throwing an error
        if ($key === 'type') {
            return null;
        }

        CLI::error("Invalid format for '{$key}'. Use '{$key}={value}'.");
        return null;
    }

    /**
     * Get the directories for views, SCSS, and JS files.
     *
     * @param string|null $type
     * @return array
     */
    private function getDirectories(?string $type): array
    {
        $baseViewDir = APPPATH . 'Views/';
        $baseScssDir = ROOTPATH . 'resources/src/scss/';
        $baseJsDir = ROOTPATH . 'resources/src/js/';

        return [
            'view' => $type ? $baseViewDir . $type . '/' : $baseViewDir,
            'scss' => $type ? $baseScssDir . $type . '/' : $baseScssDir,
            'js' => $type ? $baseJsDir . $type . '/' : $baseJsDir,
        ];
    }

    /**
     * Create a file if it doesn't exist.
     *
     * @param string $filePath
     * @param string $content
     */
    private function createFile(string $filePath, string $content)
    {
        if (file_exists($filePath)) {
            CLI::error("The file '{$filePath}' already exists.");
            return;
        }

        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }

        file_put_contents($filePath, $content);
        CLI::write("File '{$filePath}' created successfully.", 'green');
    }

    /**
     * Delete a file if it exists.
     *
     * @param string $filePath
     */
    private function deleteFile(string $filePath)
    {
        if (!file_exists($filePath)) {
            CLI::error("The file '{$filePath}' does not exist.");
            return;
        }

        unlink($filePath);
        CLI::write("File '{$filePath}' deleted successfully.", 'green');
    }
}