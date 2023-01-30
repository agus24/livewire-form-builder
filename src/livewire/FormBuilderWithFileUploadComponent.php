<?php
namespace Gustiawan\LivewireFormBuilder\livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Gustiawan\LivewireFormBuilder\Traits\UseFormBuilder;

class FormBuilderWithFileUploadComponent extends Component
{
    use UseFormBuilder, WithFileUploads;

    private $tmpImage = [];

    public function submit()
    {
        foreach ($this->formBuilder as $builder) {
            if ($builder['type'] == "file") {
                $this->tmpImage[] = [
                    "key" => $builder['model'],
                    "content" => $this->form[$builder['model']]
                ];

                $this->form[$builder['model']] = $this->uploadFile($builder, $this->form[$builder['model']]);
            }
        }

        if (count($this->ruleList) > 0) {
            $this->validate($this->ruleList);
        }

        $this->emit('submit', $this->form);
        $this->restoreFileUploadContent();
    }

    private function uploadFile($builder, $file): string
    {
        $output = $file->store($builder['path']);
        return $output;
    }

    private function restoreFileUploadContent()
    {
        foreach ($this->tmpImage as $image) {
            $this->form[$image['key']] = $image['content'];
        }

        $this->tmpImage = [];
    }
}
