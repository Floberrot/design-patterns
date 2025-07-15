<?php

namespace App\Patterns\Composite;

class TaskGroup extends AbstractTask implements TaskInterface
{
    /**
     * @var TaskInterface[]
     */
    private array $tasks = [];

    public function __construct(
        private string $name,
    )
    {
    }

    public function getContent($level = 0): string
    {
        $indent = str_repeat('  ', $level);
        $content = "{$indent}Task Group: {$this->name}\n";
        foreach ($this->getChildren() as $task) {
            if ($task instanceof self) {
                $content .= $task->getContent($level + 1);
                continue;
            }

            $content .= "{$indent}- " . $task->getContent() . "\n";
        }

        return $content;
    }

    public function add(TaskInterface $task): void
    {
        $this->tasks[] = $task;
    }

    /**
     * @return TaskInterface[]
     */
    private function getChildren(): array
    {
        return $this->tasks;
    }

    public function toTxt(): void
    {
        $content = $this->getContent();
        $content .= "\nTotal tasks: " . count($this->tasks) . "\n";
        $content .= "Task group '{$this->name}' saved to {$this->name}.txt\n";
        $content .= str_repeat("-", 20) . "\n";

        file_put_contents("public/{$this->slugifyName()}.txt", $content);
    }

    private function slugifyName(): string
    {
        return strtolower(str_replace(' ', '-', $this->name));
    }
}
